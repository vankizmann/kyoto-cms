<?php

namespace Kyoto\Assets\Plugins;

trait ScriptPlugin
{
    /**
     * Script store.
     *
     * @var array
     */
    public $scripts = [];

    /**
     * Register script in compiler.
     *
     * @param string $name
     * @param string $path
     * @param array $deps
     * @param array $attrs
     * @return void
     */
    public function script($name, $path = null, $deps = [], $attrs = [])
    {
        $this->scripts[$name] = [
            'path' => $path, 'deps' => $deps, 'attrs' => $attrs
        ];
    }

    /**
     * Output scripts to embedable string.
     *
     * @return string
     */
    public function outputScriptPlugin()
    {
        return collect($this->scripts)->sortByDeps()
            ->map([$this, 'renderScript'])->implode("\n");
    }

    /**
     * Render single script file.
     *
     * @param array $script
     * @return string
     */
    public function renderScript($script)
    {
        return '<script src="' . app('kyoto.assets')->file($script['path']) . '"></script>';
    }

}
