<?php

namespace App\Providers;

use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('timezone', function ($attribute, $value, $parameters, $validator) {
            return collect(timezones())->contains($value);
        });
    }
}
