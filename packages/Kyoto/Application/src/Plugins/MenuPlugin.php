<?php

namespace Kyoto\Application\Plugins;

use Kyoto\Menu\Models\Menu;

trait MenuPlugin
{
    public $menu = null;

    public $root = null;

    public function setMenu($menu = null)
    {
        $this->menu = $menu ?: app('kyoto.menu')->getMenuByUrl();

        if ( ! $this->menu ) {
            abort(404);
        }

        $this->root = app('kyoto.user')->unguarded(function () {
            return $this->menu->getRoot();
        });

        return $this->menu;
    }

    public function getMenu($key = null, $fallback = null)
    {
        if ( $key ) {
            return data_get($this->menu, $key, $fallback);
        }

        return $this->menu;
    }

    public function getRoot($key = null, $fallback = null)
    {
        if ( $key ) {
            return data_get($this->root, $key, $fallback);
        }

        return $this->root;
    }

    public function getLayout()
    {
        return data_get($this->menu, 'layout') ?: 'kyoto/theme::default';
    }

}
