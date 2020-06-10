<?php

namespace Kyoto\Menu;

use Kyoto\Menu\Models\Menu;
use Kyoto\Routing\Route\RouteHelper;

class MenuManager {

    const CACHE_PATH = 'framework/cache/kyo_menus.php';

    public $cached = [
        //
    ];

    public function __construct()
    {
        $this->load();
    }

    public function load()
    {
        $path = storage_path(self::CACHE_PATH);

        if ( ! file_exists($path) ) {
            $this->update();
        }

        $this->cached = require $path;
    }

    public function update()
    {
        file_put_contents(storage_path(self::CACHE_PATH),
            "<?php \n return " . var_export(Menu::where('type', '!=', 'kyoto/menu::domain')->get()->toArray(), true) . ";");
    }

    public function findByUrl($url = null)
    {
        foreach ( $this->cached as $menu ) {
            if ( RouteHelper::isRoute($menu['path'], $url) ) {
                return $menu;
            }
        }

        return null;
    }

}
