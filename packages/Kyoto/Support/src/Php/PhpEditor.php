<?php

namespace Kyoto\Support\Php;

class PhpEditor
{
    public $path;

    public $content;

    public function __construct($path = null)
    {
        if ( ! $path ) {
            throw new \Exception('Path is required for PhpEditor');
        }

        $this->path = $path;
    }

    public function load($fallback = null)
    {
        if ( ! file_exists($this->path) ) {
            return $fallback;
        }

        return $this->content = include $this->path;
    }

    public static function loadFile($path, $fallback = null)
    {
        return (new self($path))->load($fallback);
    }

    public function save($data)
    {
        file_put_contents($this->path, "<?php \n return " . var_export($data, true) . ";");

        return $this;
    }

    public static function saveFile($path, $data)
    {
        return (new self($path))->save($data);
    }

}
