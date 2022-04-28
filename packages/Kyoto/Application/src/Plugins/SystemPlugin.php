<?php

namespace Kyoto\Application\Plugins;

trait SystemPlugin
{
    /**
     * System state.
     *
     * @var boolean
     */
    public $systemState = false;

    /**
     * Register language plugin
     *
     * @return void
     */
    public function registerSystemPlugin()
    {
        if ( ! isset($_COOKIE['kyoto_sysmode']) ) {
            return;
        }

        $this->systemState = filter_var($_COOKIE['kyoto_sysmode'],
            FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get system state
     *
     * @return string
     */
    public function getSystemState()
    {
        return $this->systemState;
    }

    /**
     * Set system state
     *
     * @param $state
     */
    public function setSystemState($state)
    {
        $this->systemState = $state;
    }

    public function isSystemEnabled()
    {
        return $this->systemState === true;
    }

    public function isSystemDisabled()
    {
        return $this->systemState === false;
    }

}
