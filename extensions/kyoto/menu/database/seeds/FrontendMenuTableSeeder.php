<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Kyoto\Menu\Models\Menu;

class FrontendMenuTableSeeder extends Seeder
{

    public function run()
    {
        $redirect = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::redirect',
            'layout'    => null,
            'option'    => ['url' => ':http://:domain/:locale', 'status' => 302],
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Redirect',
            'slug'      => ':http://:domain',
        ]);

//        $tmp->fill([
//            'title'         => 'Weiterleitung',
//            'slug'          => null,
//            '_locale'       => 'de',
//        ])->save();

        $domain = Menu::create([
            'id'        => uuid(),
            'ident'     => 'web-frontend',
            'type'      => 'kyoto/menu::domain',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'www.website.com',
            'slug'      => ':http://:domain/:locale',
        ]);

        $default = Menu::create([
            'id'        => uuid(),
            'ident'     => 'menu-default',
            'type'      => 'kyoto/menu::menu',
            'layout'    => 'kyoto/frontend::default',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Mainmenu',
            'slug'      => '/',
            'parent'    => $domain,
        ]);

        $footer = Menu::create([
            'id'        => uuid(),
            'ident'     => 'menu-footer',
            'type'      => 'kyoto/menu::menu',
            'layout'    => 'kyoto/frontend::test',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Footermenu',
            'slug'      => '/',
            'parent'    => $domain,
        ]);

        $login = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/user::login',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Login',
            'slug'      => 'login',
            'matrix'    => 1,
            'parent'    => $default,
        ]);

        Menu::create([
            'type'   => 'kyoto/menu::redirect',
            'layout' => null,
            'option' => ['url' => 'http://wieistmeineip.de'],
            'state'  => 1,
            'hide'   => 0,
            'title'  => 'wieistmeineip.de',
            'slug'   => 'wieistmeineip-de',
            'matrix' => 1,
            'parent' => $default,
        ]);

        Menu::create([
            'type'   => 'kyoto/shop::product',
            'layout' => null,
            'option' => [],
            'state'  => 1,
            'hide'   => 0,
            'title'  => 'Testproduct',
            'slug'   => 'testproduct',
            'matrix' => 1,
            'parent' => $default,
        ]);

    }

}
