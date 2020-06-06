<?php

namespace Kyoto\Extension\Config;

use Illuminate\Support\Facades\Artisan;
use Kyoto\Support\Mapper\DataMapper;

class ExtensionConfig extends DataMapper
{
    public $path;
    public $rath;

    public $data;

    public function __construct($path)
    {
        $this->path = dirname($path);
        $this->rath = str_replace(base_path(), '', $this->path);
        $this->boot();
    }

    public function boot()
    {
        $data = include str_join('/', $this->path, 'config.php');

        if ( empty($data['name']) ) {
            throw new \Exception("Parameter name missing in '$this->path'");
        }

        $this->data = $data;
    }

    public function install()
    {
        if ( file_exists(str_join('/', $this->path, 'database/migrations')) ) {
            Artisan::call('migrate', ['--path' => str_join('/', $this->rath, 'database/migrations')]);
        }

        foreach ( $this->get('seeds', []) as $seed ) {
            Artisan::call('db:seed', ['--class' => $seed]);
        }

        return $this;
    }

    public function uninstall()
    {
        if ( file_exists(str_join('/', $this->path, 'database/migrations')) ) {
            Artisan::call('migrate:rollback', ['--path' => str_join('/', $this->rath, 'database/migrations')]);
        }

        return $this;
    }

}
