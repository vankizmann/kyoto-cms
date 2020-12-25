<?php

namespace Kyoto\Installer;

use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Kyoto\Installer\Console\Commands\InstallerResetCommand::class,
            \Kyoto\Installer\Console\Commands\InstallerSetupCommand::class
        ]);
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
