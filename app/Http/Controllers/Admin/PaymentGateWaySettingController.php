<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateWaySetting;
use App\Services\PaymentGatewayService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use PDO;

class PaymentGateWaySettingController extends Controller
{
    use FileUploadTrait;
    public function index(){
        $paymentGateway = PaymentGateWaySetting::pluck('value','key');
        return view('admin.payment-setting.index',compact('paymentGateway'));
    }
    public function updatePaymentGateWaySetting(Request $request){
        $validatedData = $request->validate([
            'paypal_status'=>['required','boolean'],
            'paypal_account_mode'=>['required','in:sandbox,live'],
            'paypal_country'=>['required'],
            'paypal_currency'=>['required'],
            'paypal_rate'=>['required','numeric'],
            'paypal_api_key'=>['required'],
            'paypal_secret_key'=>['required'],
            'paypal_app_id'=>['required'],
        ]);
        if($request->hasFile('paypal_logo')){
            $request->validate([
            'paypal_logo'=>['required','image']
            ]);
            $image_upload = $this->uploadImage($request,'paypal_logo');
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>'paypal_logo'],
                ['value'=>$image_upload]
            );
        }
        foreach($validatedData as $key=>$value){
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>$key],
                ['value'=>$value]
            );
        }
        //delete
        $settingService = app(PaymentGatewayService::class);
        $settingService->clearCacheSettings();

        toastr()->success('Updated successfully');
        return redirect()->back();
    }
    //paypal payments
}
