<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Kyoto\Menu\Models\Menu;

class FrontendMenuTableSeeder extends Seeder
{

    public function run()
    {
        $tmp = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::redirect',
            'layout'    => null,
            'option'    => ['url' => ':http://:domain/:locale', 'status' => 302],
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
            'type'      => 'kyoto/menu::domain',
            'layout'    => 'kyoto/frontend::default',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'www.website.com',
            'slug'      => ':http://:domain/:locale',
            'guard'     => 0,
        ]);

        $home = Menu::create([
            'id'        => uuid(),
            'ident'     => 'web-home',
            'type'      => 'kyoto/page::page',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Homepage',
            'slug'      => '/',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $root,
        ]);

        $home->localized('de')->update([
            'title'         => 'Startseite'
        ]);

        $home->localized('da')->update([
            'title'         => 'Hjem',
        ]);

        $home->localized('ru')->update([
            'title'         => 'Начните',
        ]);

        $login = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/user::login',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Login',
            'slug'      => '/login',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $root,
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/page::page',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Hmm',
            'slug'      => '/hm/:any',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $root,
        ]);


        $demo = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/page::page',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Demo EN',
            'slug'      => '/demo-en',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $root,
        ]);

        $demo->localized('de')->update([
            'title'         => 'Demo DE',
            'slug'          => '/demo-de'
        ]);

        $demo->localized('ru')->update([
            'title'         => 'Demo RU',
            'slug'          => '/demo-ru'
        ]);

        $test = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/page::page',
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Test EN',
            'slug'      => '/test-en',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $demo,
        ]);

        $test->localized('de')->update([
            'title'         => 'Test DE',
            'slug'          => '/test-de'
        ]);

        $test->localized('da')->update([
            'title'         => 'Test DA',
            'slug'          => '/test-da'
        ]);


        foreach ( range(0, 200) as $index ) {
            continue;

            Menu::create([
                'id'     => uuid(),
                'type'   => 'kyoto/menu::redirect',
                'layout' => null,
                'option' => ['url' => 'http://wieistmeineip.de'],
                'state'  => 1,
                'hide'   => 0,
                'title'  => 'Redirect ' . $index,
                'slug'   => '/redirect' . $index,
                'matrix' => 1,
                'guard'  => 0,
                'parent' => $root,
            ]);

        }


    }

}
