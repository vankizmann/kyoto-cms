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
            return $this->menu->root();
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
        $layout = 'kyoto/theme::default';

        if ( ! $this->menu ) {
            return $layout;
        }

        foreach ( app('kyoto.menu')->getMenus() as $menu ) {

            if ( ! empty($menu['layout']) ) {
                $layout = $menu['layout'];
            }

            if ( $menu['id'] === $this->menu['id'] ) {
                break;
            }
        }

        return $layout;
    }

}
