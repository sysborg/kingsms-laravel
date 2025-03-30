<?php
namespace Sysborg\KingSMS\Providers;

use Illuminate\Support\ServiceProvider;
use Sysborg\KingSMS\Channels\KingsmsChannel;
use Illuminate\Support\Facades\Notification;
use Sysborg\KingSMS\Service\KingSMS;

class KingSMSProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kingsms.php', 'kingsms');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('kingsms', function ($app) {
            return new KingSMS(config('kingsms.login'), config('kingsms.token'));
        });

        Notification::extend('kingsms', function ($app) {
            return $app->make(KingsmsChannel::class);
        });
    }
}
