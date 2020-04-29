<?php

namespace Kyoto\Application;

use Illuminate\Support\ServiceProvider;

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
        $this->publishes([
            __DIR__.'/../config/kyoto.php' => config_path('kyoto.php'),
        ]);

        app('kyoto')->boot();
    }

}
