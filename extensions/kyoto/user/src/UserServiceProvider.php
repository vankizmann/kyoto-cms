<?php

namespace Kyoto\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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

        app()->singleton('kyoto.user', function () {
            return new UserManager();
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
