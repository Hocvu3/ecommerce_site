<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function emailSettings(){
        // $paymentGateway = PaymentGateWaySetting::pluck('value','key');
        // return view('admin.payment-setting.index',compact('paymentGateway'));
        //dd(config('mail'));
        return view('admin.settings.email.index');
    }
    public function emailSettingsUpdate(Request $request){
        $validation = $request->validate([
            'mailer' => 'required',
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address'=>'required',
            'mail_receive_address'=>'required'
        ]);
        foreach($validation as $key => $value){
            Settings::updateOrCreate(
                ['key'=>$key],
                ['value'=>$value]
            );
        }
        $settingsService = app(SettingService::class);
        $settingsService->clearCacheSettings();
        Cache::forget('mail_settings');

        toastr()->success('Email setting updated successfully!');
        return redirect()->back();
    }
}
