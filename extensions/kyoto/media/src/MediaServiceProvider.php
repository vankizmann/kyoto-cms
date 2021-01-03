<?php

namespace Kyoto\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
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

        app()->singleton('kyoto.media', function () {
            return new MediaManager();
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
