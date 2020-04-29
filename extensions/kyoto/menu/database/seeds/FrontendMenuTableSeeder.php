<?php

use App\Database\MenuLocale;
use Illuminate\Database\Seeder;
use App\Database\Menu;

class FrontendMenuTableSeeder extends Seeder
{

    public function run()
    {
        $tmp = Menu::create([
            'id'        => uuid(),
            'type'      => 'web-menu::redirect',
            'layout'    => null,
            'extend'    => ['url' => ':http://:domain/:locale'],
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Redirect',
            'slug'      => ':http://:domain',
            'guard'     => 0,
        ]);

//        $tmp->fill([
//            'title'         => 'Weiterleitung',
//            'slug'          => null,
//            '_locale'       => 'de',
//        ])->save();

        $root = Menu::create([
            'id'        => uuid(),
            'type'      => 'web-menu::domain',
            'layout'    => 'layout',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'www.website.com',
            'slug'      => ':http://:domain/:locale',
            'guard'     => 0,
        ]);

        $home = Menu::create([
            'id'        => uuid(),
            'ident'     => 'web-home',
            'type'      => 'web-page::page',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Homepage',
            'slug'      => '/homepage',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $root,
        ]);

        $home->localize('de')->update([
            'title'         => 'Startseite',
            'slug'          => '/startseite'
        ]);

        $home->localize('da')->update([
            'title'         => 'Hjem',
            'slug'          => '/hjem'
        ]);

        $login = Menu::create([
            'id'        => uuid(),
            'type'      => 'web-auth::login',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Login',
            'slug'      => '/login',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $root,
        ]);

        $demo = Menu::create([
            'id'        => uuid(),
            'type'      => 'web-page::page',
            'layout'    => 'demo',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Demo',
            'slug'      => '/demo',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $root,
        ]);

        foreach ( range(0, 600) as $index ) {
            Menu::create([
                'id'     => uuid(),
                'type'   => 'web-menu::redirect',
                'layout' => null,
                'extend' => ['url' => 'http://wieistmeineip.de'],
                'state'  => 1,
                'hide'   => 0,
                'title'  => 'Home',
                'slug'   => '/redirect' . $index,
                'matrix' => 1,
                'guard'  => 0,
                'parent' => $root,
            ]);
        }

    }

}
