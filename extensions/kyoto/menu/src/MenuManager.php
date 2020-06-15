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
        $this->load();
    }

    public function load()
    {
        foreach ( app('kyoto')->getLocales() as $locale ) {

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            if ( ! file_exists($path) ) {
                $this->update($locale);
            }

            $this->menus[$locale] = PhpEditor::loadFile($path);
        }
    }

    public function update($locale)
    {
        app('kyoto')->localized($locale, function ($locale) {

            $menus = Menu::enabled()->whereNotIn('type', $this->exclude)
                ->get()->toArray();

            $path = storage_path(str_join('/',
                self::CACHE_PATH, "{$locale}.php"));

            PhpEditor::saveFile($path, $menus);
        });
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

}
