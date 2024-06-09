<?php
namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentGateWaySetting;
use App\Models\Settings;
use Cache;
use Cart;

class SettingService{
    function getSettings(){
        return Cache::rememberForever('settingsService',function(){
            return Settings::pluck('value','key')->toArray();
        });
    }
    function setGlobalSettings(){
        $settings = $this->getSettings();
        config()->set('settingsService',$settings);
    }
    function clearCacheSettings(){
        Cache::forget('settingsService');
    }
}
