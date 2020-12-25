<?php

namespace Kyoto\Installer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallerSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'installer:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup kyoto application.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(0);

        if ( app('kyoto')->isReady() ) {
            return 0;
        }

        // Mirgate database
        Artisan::call('migrate:refresh', [
            '--path' => 'database/migrations'
        ]);

        $this->info("Done migrating application data...");

        foreach ( app('kyoto.extension')->getActiveConfigs() as $config ) {
            $config->install();
            $this->info("Done installing extension {$config->data['name']}...");
        }

        app('kyoto')->setReady();
        $this->info("Setting app to ready...");

        return 1;
    }
}
