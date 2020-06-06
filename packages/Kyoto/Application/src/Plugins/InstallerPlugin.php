<?php

namespace Kyoto\Application\Plugins;

trait InstallerPlugin
{
    public $ready = false;

    /**
     * Register ready plugin
     *
     * @return void
     */
    public function registerInstallerPlugin()
    {
        $this->ready = file_exists(base_path('.install'));
    }

    public function isReady()
    {
        return $this->ready;
    }

    public function setReady()
    {
        file_put_contents(base_path('.install'), date('Y-m-d H:i:s'));

        $this->ready = true;
    }

}
