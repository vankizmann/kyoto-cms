<?php

namespace Kyoto\Application;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Kyoto\Support\Validation\CustomRules;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kyoto.php', 'kyoto');

        $this->app->singleton('kyoto', function () {
            return new KyotoInstance();
        });

        app('kyoto')->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_val', function ($attribute, $value, $parameters) {
            return (new CustomRules)->unique_val($attribute, $value, $parameters);
        });

        Validator::extend('requiredNew', function ($attribute, $value, $parameters) {
            return (new CustomRules)->required_new($attribute, $value, $parameters);
        });

        $this->publishes([
            __DIR__.'/../config/kyoto.php' => config_path('kyoto.php'),
        ]);

        app('kyoto')->boot();
    }

}
