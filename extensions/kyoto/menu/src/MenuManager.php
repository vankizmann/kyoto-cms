<?php

namespace Kyoto\Menu;

use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Menu\Models\Menu;
use Kyoto\Support\Php\PhpEditor;
use Kyoto\Routing\Route\RouteHelper;

class MenuManager {

    const MENU_PATH = 'kyoto/menu';

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

    public function loadMenus()
    {
        foreach ( Kyoto::getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::MENU_PATH, "{$locale}.php"));

            if ( ! file_exists($path) ) {
                $this->updateMenu($locale);
            }

            $this->menus[$locale] = PhpEditor::loadFile($path);
        }
    }

    public function updateMenu($locale)
    {
        Kyoto::localized($locale, function ($locale) {

            $menus = KyotoUser::unguarded(function () {
                return Menu::enabled()->whereNotIn('type', $this->exclude)
                    ->get()->toArray();
            });

            $path = storage_path(str_join('/', self::MENU_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $menus);
        });
    }

    public function updateMenus()
    {
        foreach ( Kyoto::getLocales() as $locale ) {
            $this->updateMenu($locale);
        }
    }

    public function clearMenus()
    {
        $path = storage_path(str_join('/',
            self::MENU_PATH, '*.php'));

        foreach ( glob($path) as $file ) {
            unlink($file);
        }

        return $this;
    }

    public function getMenus()
    {
        return $this->menus[app()->getLocale()];
    }

    public function getMenuByUrl($url = null)
    {
        $menu = null;

        foreach ( $this->menus[app()->getLocale()] as $item ) {
            if ( RouteHelper::isRoute($item['path'], $url) ) {
                $menu = $item;
            }
        }

        if ( ! empty($menu) ) {
            return Menu::find($menu['id']);
        }

        return null;
    }

}
