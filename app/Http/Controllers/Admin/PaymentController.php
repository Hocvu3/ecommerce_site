<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlaceNotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\OrderPlaceMail;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session()->has('delivery_fee') && !session()->has('address')) {
            throw \Illuminate\Validation\ValidationException::withMessages(['Attempt Failed']);
        }
        $subTotal = cartTotal();
        $deliveryCharge = session()->get('delivery_fee') ?? 0;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $grandTotal = grandCartTotal($deliveryCharge);
        return view('frontend.pages.payment', compact(
            'subTotal',
            'deliveryCharge',
            'discount',
            'grandTotal'
        ));
    }
    public function makePayment(Request $request, OrderService $orderService)
    {
        //dd('hi');
        $request->validate([
            'payment_gateway' => ['required', 'string', 'in:paypal,momo,vnpay'],
        ]);
        if ($orderService->createOrder()) {
            switch ($request->payment_gateway) {
                case 'paypal':
                    return response(['redirect_url' => route('payment.paypal')]);
                    break;
                case 'momo':
                    return response(['redirect_url' => route('payment.momo')]);
                    break;
                case 'vnpay':
                    return response(['redirect_url' => route('payment.vnpay')]);
                    break;
                default:
                    break;
            }
        }
    }
    function setPaypalConfig()
    {
        $config = [
            'mode'    => config('gatewaySettings.paypal_account_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => config('gatewaySettings.paypal_api_key'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gatewaySettings.paypal_api_key'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => config('gatewaySettings.paypal_currency'),
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true // Validate SSL when creating api client.
        ];
        return $config;
    }
    //payment
    function payWithPayPal()
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $grand_total = session()->get('grand_total');
        $payable_amount = round($grand_total * config('gatewaySettings.paypal_rate'));
        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('payment.paypal.success'),
                'cancel_url' => route('payment.paypal.cancel')
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('gatewaySettings.paypal_currency'),
                        'value' => $payable_amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != NULL) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('payment.cancel')->withErrors(['errors' => $response['error']['message']]);
        }
    }
    function successPayPal(Request $request, OrderService $orderService)
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            //update orders
            $orderId = session()->get('order_id');
            $payment_info = [
                'transaction_id' => $response['purchase_units'][0]['payments']['captures'][0]['id'],
                'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'status' => strtolower($response['purchase_units'][0]['payments']['captures'][0]['status']),
            ];
            //one for update one for sending email
            OrderPaymentUpdateEvent::dispatch($orderId, $payment_info, 'paypal');
            OrderPlaceNotificationEvent::dispatch($orderId);
            $orderService->clearSession();
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.cancel')->withErrors(['errors' => $response['error']['message']]);
        }
    }
    function cancelPayPal()
    {
        return redirect()->route('payment.cancel');
    }

    //momo part
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    function payWithMomo(OrderService $orderService)
    {
        // //if (!empty($_POST)) {
        //     // $partnerCode = $partnerCode;
        //     // $accessKey = $_POST["accessKey"];
        //     // $serectkey = $_POST["secretKey"];
        //     // $orderId = $_POST["orderId"]; // Mã đơn hàng
        //     // $orderInfo = $_POST["orderInfo"];
        //     // $amount = $_POST["amount"];
        //     // $ipnUrl = $_POST["ipnUrl"];
        //     // $redirectUrl = $_POST["redirectUrl"];
        //     // $extraData = $_POST["extraData"];

        //     $requestId = time() . "";
        //     $requestType = "payWithATM";
        //     //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        // Lấy giá trị grand_total từ session và đảm bảo nó là số nguyên
        $grand_total = session()->get('grand_total');
        $amount = intval($grand_total);  // Chuyển đổi grand_total thành số nguyên
        // session()->get('order_id');
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $orderId =  time() . "";
        $redirectUrl = "http://ecommerce.test/payment-success";
        $ipnUrl = "http://ecommerce.test/payment-success";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tạo rawHash với giá trị amount mới
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        // Tạo chữ ký
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Tạo mảng dữ liệu
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Gửi yêu cầu và xử lý kết quả
        $result = $this->execPostRequest($endpoint, json_encode($data));
        //dd($result);
        $jsonResult = json_decode($result, true);  // Giải mã JSON
        //dd($jsonResult);
        $payment_info = [
            'transaction_id' => $jsonResult['orderId'],
            'currency' => 'VND',
            'status' => 'completed',
        ];
        OrderPaymentUpdateEvent::dispatch(session()->get('order_id'), $payment_info, 'momo');
        $orderService->clearSession();
        return redirect()->to($jsonResult['payUrl']);
    }
    //VnPay
    public function payWithVnpay(OrderService $orderService)
    {
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://ecommerce.test/payment-success";
    $vnp_TmnCode = "F45XV5RA";
    $vnp_HashSecret = "L5K3VPA7E27G1O4VH72VENEEXI9K8J4Q";

    $grand_total = session()->get('grand_total');

    $vnp_TxnRef = time() . "";
    $vnp_OrderInfo = 'Thanh toan don hang';
    $vnp_OrderType = 'Sale';
    $vnp_Amount = $grand_total * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    //dd($vnp_Url);
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    //dd($vnp_Url);
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        $payment_info = [
            'transaction_id' => $vnp_TxnRef,
            'currency' => 'VND',
            'status' => 'completed',
        ];
        OrderPaymentUpdateEvent::dispatch(session()->get('order_id'), $payment_info, 'vnpay');
        $orderService->clearSession();
        return redirect()->to($vnp_Url);
    }
    function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }
    function paymentCancel()
    {
        return view('frontend.pages.payment-cancel');
    }
}
