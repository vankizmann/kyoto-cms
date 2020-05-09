<?php

namespace Kyoto\Assets;

use Kyoto\Support\Instance\InstanceElement;

class AssetsManager extends InstanceElement
{
    use Plugins\ScriptPlugin;
    use Plugins\StylePlugin;

    /**
     * Namespace store.
     *
     * @var array
     */
    public $namespaces = [];

    /**
     * Manifest store.
     *
     * @var array
     */
    public $manifests = [];

    /**
     * Extensions store.
     *
     * @var array
     */
    public $extensions = [];

    public function addNamespace($namespace, $hint)
    {
        $hint = preg_replace('/^' . preg_quote(public_path(), '/') . '/', '', $hint);

        $this->namespaces[$namespace] = $hint;
    }

    public function addManifest($source, $target)
    {
        $this->manifests[$source] = $target;
    }

    public function file($link, $secure = null)
    {
        foreach ($this->manifests as $source => $target) {
            $link = preg_replace('/^' . preg_quote($source, '/') . '$/',
                $target, $link);
        }

        foreach ($this->namespaces as $namespace => $hint) {
            $link = preg_replace('/^' . preg_quote($namespace, '/') . '::\/?/',
                rtrim($hint, '/') . '/', $link);
        }

        if ( ! preg_match('/^http?s:\/\//', $link) ) {
            $link = app('url')->to($link, [], $secure);
        }

        return $link;
    }

    public function output()
    {
        $output = [];

        foreach ( class_uses_recursive(static::class) as $trait ) {
            $output[] = $this->outputTrait($trait);
        }

        return implode("\n", array_filter($output));
    }

    public function outputTrait($trait)
    {
        $outputMethod = 'output' . class_basename($trait);

        if ( ! method_exists($this, $outputMethod) ) {
            return null;
        }

        return app()->call([$this, $outputMethod]);
    }

}
