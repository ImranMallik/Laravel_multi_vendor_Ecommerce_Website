<?php

namespace App\Providers;

use App\Models\GenaralSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // set time zone in config
        $GenaralSetting = GenaralSetting::first();
        Config::set('app.timezone', $GenaralSetting->time_zone);

        view()->composer('*', function ($view) use ($GenaralSetting) {
            $view->with('settings', $GenaralSetting);
        });
    }
}
