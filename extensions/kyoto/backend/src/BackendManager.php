<?php

namespace Kyoto\Backend;

use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Language\Facades\KyotoLanguage;
use Kyoto\Routing\Route\RouteHelper;

class BackendManager {

    public $scripts = [
        //
    ];

    public $styles = [
        //
    ];

    public function addFile($name, $file = null, $deps = [])
    {
        if ( $file === null ) {
            $file = $name;
        }

        if ( preg_match('/\.css/', $file) ) {
            return $this->styles[$name] = [$file, $deps];
        }

        if ( preg_match('/\.js/', $file) ) {
            return $this->scripts[$name] = [$file, $deps];
        }

        throw new \Exception("File \"{$file}\" is not supported.");
    }

    public function addFiles($files)
    {
        foreach ( $files as $file ) {
            $this->addFile(...(is_array($file) ? $file : [$file]));
        }

        return $this;
    }

    public function output()
    {
        foreach ($this->styles as $name => $style) {
            app('kyoto.assets')->style($name, ...$style);
        }

        foreach ($this->scripts as $name => $script) {
            app('kyoto.assets')->script($name, ...$script);
        }

        return app('kyoto.assets')->output();
    }

    public function basePath()
    {
        return RouteHelper::getRoute(app('kyoto')->getMenu('path'));
    }

    public function getTranslations()
    {
        return KyotoLanguage::getTranslations();
    }

    public function loginPath()
    {
        return RouteHelper::getRoute(app('kyoto')->getMenu()->getLogin('path'));
    }

    public function logoutPath()
    {
        return RouteHelper::getRoute(app('kyoto')->getMenu()->getLogout('path'));
    }

    public function backendRoutes()
    {
        return Kyoto::getMenu()->getDescendants()
            ->toHierarchy()->values()->toArray();
    }

    public function backendLanguages()
    {
        return KyotoLanguage::getLanguages();
    }

    public function backendUser()
    {
        return KyotoUser::getUser()->toArray();
    }

}
