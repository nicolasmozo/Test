<?php

namespace App\Providers;

use App\Models\ProviderWithdraw;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use View;
use Auth;
use Session;
use Artisan;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function($view){
            $setting = Setting::first();
            $pendingWithdrawCounter = ProviderWithdraw::pending()->count();
            $view->with('pendingWithdrawCounter', $pendingWithdrawCounter);
            $view->with('setting', $setting);
            $view->with('default_avatar', $setting->default_avatar);
            $view->with('currency', $setting->currency_icon);
        });
    }
}
