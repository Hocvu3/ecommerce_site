<?php

namespace App\Providers;

use App\Models\Settings;
use Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CustomMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mailSettings = Cache::rememberForever('mail_settings', function () {
            $key = [
                'mailer',
                'mail_driver',
                'mail_host',
                'mail_port',
                'mail_username',
                'mail_password',
                'mail_encryption',
                'mail_from_address',
                'mail_receive_address',
            ];
            return Settings::whereIn('key',$key)->pluck('value','key')->toArray();
        });
        if($mailSettings){
            Config::set('mail.default', $mailSettings['mailer']);
            Config::set('mail.mailers.smtp.driver', $mailSettings['mail_driver']);
            Config::set('mail.mailers.smtp.host', $mailSettings['mail_host']);
            Config::set('mail.mailers.smtp.port', $mailSettings['mail_port']);
            Config::set('mail.mailers.smtp.username', $mailSettings['mail_username']);
            Config::set('mail.mailers.smtp.password', $mailSettings['mail_password']);
            Config::set('mail.mailers.smtp.driver', $mailSettings['mail_driver']);
            Config::set('mail.from.address', $mailSettings['mail_from_address']);
        }
    }
}
