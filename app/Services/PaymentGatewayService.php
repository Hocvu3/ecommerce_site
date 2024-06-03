<?php
namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentGateWaySetting;
use Cache;
use Cart;

class PaymentGatewayService{
    function getSettings(){
        return Cache::rememberForever('gatewaySettings',function(){
            return PaymentGateWaySetting::pluck('value','key')->toArray();
        });
    }
    function setGlobalSettings(){
        $settings = $this->getSettings();
        config()->set('gatewaySettings',$settings);
    }
    function clearCacheSettings(){
        Cache::forget('gatewaySettings');
    }
}
