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
        if ( $value === true || $value === false ) {
            $value = $value ? 'true' : 'false';
        }

        if ( preg_match('/\s/', $value) ) {
            $value = "\"{$value}\"";
        }

        $target = strtoupper($key) . '=' . $value;

        if ( ! $this->has($key) ) {
            $this->content .= "\n" . $target;
        }

        $callback = function ($matches) use ($target) {
            return $matches[1] . $target . $matches[2];
        };

        $this->content = preg_replace_callback('/(^|\n)' . preg_quote(strtoupper($key)) .
            '=.*?(\n)/', $callback, $this->content);
    }

    public function get($key, $fallback = null)
    {
        if ( ! $this->has($key) ) {
            return $fallback;
        }

        preg_match('/(^|\n)' . preg_quote(strtoupper($key)) .
            '="?(.*?)"?\n/', $this->content, $matches);

        $value = trim(last($matches));

        if ( $value === 'true' || $value === 'false' ) {
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }

        return $value;
    }

    public function has($key)
    {
        return !! preg_match('/(^|\n)' . preg_quote(strtoupper($key)) .
            '=(.*?)\n/', $this->content);
    }

}
