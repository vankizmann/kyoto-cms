<?php

namespace Kyoto\Application\Plugins;

use Kyoto\Menu\Facades\KyotoMenu;
use Kyoto\User\Facades\KyotoUser;

trait MenuPlugin
{
    public $menu = null;

    public $root = null;

    public $layout = null;

    public function setMenu($menu = null)
    {
        $this->menu = $menu ?: KyotoMenu::getMenuByUrl();

        if ( ! $this->menu ) {
            abort(404);
        }

        $this->root = KyotoUser::unguarded(function () {
            return $this->menu->getRoot();
        });

        $this->setLayout();

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


    public function setLayout()
    {
        $layout = 'kyoto/frontend::default';

        if ( ! $this->menu ) {
            return $layout;
        }

        foreach ( $this->menu->getDescendantsAndSelf() as $menu ) {

            if ( ! empty($menu['layout']) ) {
                $layout = $menu['layout'];
            }

            if ( $menu['id'] === $this->menu['id'] ) {
                break;
            }
        }

        $finderPath = app('view')->getFinder()->find($layout);

        foreach ( app('view')->getFinder()->getHints() as $hint => $path ) {
            app('view')->prependNamespace($hint, str_join('/', dirname($finderPath), $hint));
        }

        return $this->layout = $layout;
    }

    public function getLayout()
    {
        if ( ! $this->layout ) {
            $this->setLayout();
        }

        return $this->layout;
    }

}
