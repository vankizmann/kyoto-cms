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
            'ident'     => 'web-frontend',
            'type'      => 'kyoto/menu::domain',
            'layout'    => 'kyoto/frontend::default',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'www.website.com',
            'slug'      => ':http://:domain/:locale',
            'guard'     => 0,
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
            'guard'     => 0,
            'parent'    => $root,
        ]);

        foreach ( range(0, 10) as $index ) {

            Menu::create([
                'type'   => 'kyoto/menu::redirect',
                'layout' => null,
                'option' => ['url' => 'http://wieistmeineip.de'],
                'state'  => 1,
                'hide'   => 0,
                'title'  => 'Redirect ' . $index,
                'slug'   => 'redirect' . $index,
                'matrix' => 1,
                'guard'  => 0,
                'parent' => $root,
            ]);

        }

    }

}
