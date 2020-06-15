<?php

namespace Kyoto\Language;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ( ! app('kyoto')->isReady() ) {
            return;
        }

        app()->singleton('kyoto.language', function () {
            return new LanguageManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
