<?php

namespace App\Providers;

use App\Services\PaymentGatewayService;
use Illuminate\Support\ServiceProvider;

class PaymentGatewaySettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayService::class,function(){
            return new PaymentGatewayService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $paymentGatewaySettings = $this->app->make(PaymentGatewayService::class);
        $paymentGatewaySettings->setGlobalSettings();
    }
}
