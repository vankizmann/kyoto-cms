<?php

namespace Kyoto\Menu;

use function foo\func;
use Kyoto\Menu\Models\Menu;
use Kyoto\Routing\Route\RouteHelper;
use Kyoto\Support\Php\PhpEditor;

class MenuManager {

    const CACHE_PATH = 'kyoto/menu';

    public $menus = [
        //
    ];

    public $exclude = [
        'kyoto/menu::domain',
        'kyoto/menu::menu'
    ];

    public function __construct()
    {
        $this->loadMenus();
    }

    public function update()
    {
        $this->updateMenus();
    }

    public function loadMenus()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            if ( ! file_exists($path) ) {
                $this->updateMenu($locale);
            }

            $this->menus[$locale] = PhpEditor::loadFile($path);
        }
    }

    public function updateMenu($locale)
    {
        app('kyoto')->localized($locale, function ($locale) {

            $menus = app('kyoto.user')->unguarded(function () {

                //
                return Menu::enabled()->whereNotIn('type', $this->exclude)
                    ->get()->toArray();
            });

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $menus);
        });
    }

    public function updateMenus()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {
            $this->updateMenu($locale);
        }
    }

    public function findByUrl($url = null)
    {
        foreach ( $this->menus[app()->getLocale()] as $menu ) {
            if ( RouteHelper::isRoute($menu['path'], $url) ) {
                return $menu;
            }
        }

        return null;
    }

    public function getMenus()
    {
        return $this->menus[app()->getLocale()];
    }

    public function getMenuByUrl($url = null)
    {
        $menu = $this->findByUrl($url);

        if ( ! empty($menu) ) {
            return Menu::find($menu['id']);
        }

        return null;
    }

}
