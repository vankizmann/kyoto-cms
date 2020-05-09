<?php

namespace Kyoto\Support\Env;

class EnvEditor
{
    public $path;

    public $content;

    public function __construct($path = null)
    {
        if ( ! $path ) {
            $path = base_path('.env');
        }

        $this->path = str_join('/', preg_replace('/\.env$/', '', $path), '.env');

        $this->load();
    }

    public function load()
    {
        if ( file_exists($this->path) ) {
            $this->content = file_get_contents($this->path);
        }
    }

    public function save()
    {
        file_put_contents($this->path, $this->content);
    }

    public function set($key, $value)
    {
        $targetLine = strtoupper($key) . '=' . $value;

        if ( ! $this->has($key) ) {
            $this->content .= "\n" . $targetLine;
        }

        $this->content = preg_replace('/(^|\n)' . preg_quote(strtoupper($key)) .
            '=.*?(\n)/', "$1{$targetLine}$2", $this->content);
    }

    public function get($key, $fallback = null)
    {
        if ( ! $this->has($key) ) {
            return $fallback;
        }

        preg_match('/(^|\n)' . preg_quote(strtoupper($key)) .
            '="?(.*?)"?\n/', $this->content, $matches);

        return trim($matches[1]);
    }

    public function has($key)
    {
        return !! preg_match('/(^|\n)' . preg_quote(strtoupper($key)) .
            '=(.*?)\n/', $this->content);
    }

}
