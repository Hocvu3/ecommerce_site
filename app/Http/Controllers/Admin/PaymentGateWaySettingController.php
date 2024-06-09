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
    public function updateMoMoPaymentGateWaySetting(Request $request){
        $validatedData = $request->validate([
            'momo_status'=>['required','boolean'],
            'momo_account_mode'=>['required','in:sandbox,live'],
            'momo_partner_code'=>['required'],
            'momo_access_key'=>['required'],
            'momo_secret_key'=>['required'],
        ]);
        foreach($validatedData as $key=>$value){
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>$key],
                ['value'=>$value]
            );
        }
        if($request->hasFile('momo_logo')){
            $request->validate([
            'momo_logo'=>['nullable','image']
            ]);
            $image_upload = $this->uploadImage($request,'momo_logo');
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>'momo_logo'],
                ['value'=>$image_upload]
            );
        }
        $settingService = app(PaymentGatewayService::class);
        $settingService->clearCacheSettings();

        toastr()->success('Updated successfully');
        return redirect()->back();
    }
    public function updateVnPayPaymentGateWaySetting(Request $request){
        $validatedData = $request->validate([
            'vnpay_status'=>['required','boolean'],
            'vnpay_account_mode'=>['required','in:sandbox,live'],
            'vnpay_partner_code'=>['required'],
            'vnpay_hash_secret'=>['required'],
        ]);
        foreach($validatedData as $key=>$value){
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>$key],
                ['value'=>$value]
            );
        }
        if($request->hasFile('vnpay_logo')){
            $request->validate([
            'vnpay_logo'=>['nullable','image']
            ]);
            $image_upload = $this->uploadImage($request,'vnpay_logo');
            PaymentGateWaySetting::updateOrCreate(
                ['key'=>'vnpay_logo'],
                ['value'=>$image_upload]
            );
        }
        $settingService = app(PaymentGatewayService::class);
        $settingService->clearCacheSettings();

        toastr()->success('Updated successfully');
        return redirect()->back();
    }
}
