<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // if (in_array(config('app.env'), ['production'])) {
        //     $this->app['request']->server->set('HTTPS','on');
        //     URL::forceScheme('https');
        // }
    }
}
