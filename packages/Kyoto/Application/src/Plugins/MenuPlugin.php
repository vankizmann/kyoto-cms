<?php

namespace Kyoto\Application\Plugins;

use Kyoto\Menu\Models\Menu;

trait MenuPlugin
{
    public $menu = null;

    public $root = null;

    /**
     * Register ready plugin
     *
     * @return void
     */
    public function bootMenuPlugin()
    {
        if ( ! $this->isReady() ) {
            return;
        }

        $menu = app('kyoto.menu')->findByUrl();

        if ( ! $menu ) {
            return;
        }

        $this->menu = Menu::findOrFail($menu['id']);

        $this->root = $this->menu->getRoot();
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
