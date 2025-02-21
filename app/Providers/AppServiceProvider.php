<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        require_once app_path().'/Helpers/helpers.php';
        require_once app_path().'/Helpers/date_time.php';

        if (env("APP_ENV") == "production") {
            $url->forceScheme('https');
        }

        \Validator::extend('not_exists', function ($attribute, $value, $parameters) {
            return \DB::table($parameters[0])
                ->where($parameters[1], $value)
                ->count() < 1;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
