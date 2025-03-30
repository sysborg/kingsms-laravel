<?php
namespace Sysborg\KingSMS\Providers;

use Illuminate\Support\ServiceProvider;
use Sysborg\KingSMS\Service\KingSMS;

class KingSMSProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/focusnfe.php', 'focusnfe');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('kingsms', function ($app) {
            return new KingSMS(config('kingsms.login'), config('kingsms.token'));
        });
    }
}
