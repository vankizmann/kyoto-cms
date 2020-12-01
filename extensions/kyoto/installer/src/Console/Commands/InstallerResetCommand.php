<?php

namespace Kyoto\Installer\Console\Commands;

use Illuminate\Console\Command;

class InstallerResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'installer:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset application to rerun installer.';

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
        $this->info('Removing language cache...');

        foreach ( glob(storage_path('kyoto/language/*.php')) as $path ) {
            unlink($path);
        }

        $this->info('Removing menu cache...');

        foreach ( glob(storage_path('kyoto/menu/*.php')) as $path ) {
            unlink($path);
        }

        $this->info('Remove install logger...');
        unlink(base_path('.install'));

        return 1;
    }
}
