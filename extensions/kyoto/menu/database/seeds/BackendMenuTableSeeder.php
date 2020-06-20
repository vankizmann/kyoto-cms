<?php

use Illuminate\Database\Seeder;
use Kyoto\Menu\Models\Menu;

class BackendMenuTableSeeder extends Seeder
{

    public function run()
    {
        $routes = [
             //
        ];

        $menus = [
            //
        ];

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::redirect',
            'layout'    => null,
            'option'    => ['url' => ':http://:domain/:locale/backend', 'status' => 302],
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Redirect',
            'slug'      => ':http://:domain/backend',
            'guard'     => 0,
            'parent_id' => null,
        ]);

        $routes['root'] = uuid();

        $menus['root'] = Menu::create([
            'id'        => $routes['root'],
            'ident'     => 'web-backend',
            'type'      => 'kyoto/backend::admin',
            'layout'    => 'kyoto/backend::default',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'liro-cms.com',
            'slug'      => ':http://:domain/:locale/backend',
            'guard'     => 1,
            'parent_id' => null,
        ]);


        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/user::login',
            'layout'    => 'kyoto/backend::login',
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Login',
            'slug'      => '/login',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $menus['root'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/user::logout',
            'layout'    => 'kyoto/backend::login',
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Logout',
            'slug'      => '/logout',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $menus['root'],
        ]);

        $routes['dashboard'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['dashboard']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Home',
            'slug'      => '/',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $menus['dashboard'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['dashboard']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Dashboard',
            'slug'      => '/dashboard',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        Menu::create([
            'id'        => $routes['dashboard'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoDashboard'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Dashboard',
            'slug'      => '/dashboard',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $routes['page'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['page']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Pages',
            'slug'      => '/pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $menus['page'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['page']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Pages',
            'slug'      => '/pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $tmp = Menu::create([
            'id'        => $routes['page'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoPages'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Pages',
            'slug'      => '/pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['page'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPageEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Edit page',
            'slug'      => '/edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $tmp,
        ]);

        $tmp = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoMenus'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Menus',
            'slug'      => '/menus',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['page'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoMenuEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Edit menu',
            'slug'      => '/edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $tmp,
        ]);

        $routes['user'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['user']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Users',
            'slug'      => '/users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $menus['user'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['user']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Users',
            'slug'      => '/users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        Menu::create([
            'id'        => $routes['user'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoUsers'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Users',
            'slug'      => '/users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoRoles'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Roles',
            'slug'      => '/roles',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoGates'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Gates',
            'slug'      => '/gates',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $routes['language'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['language']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Languages',
            'slug'      => '/language',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $menus['language'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['language']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Languages',
            'slug'      => '/languages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $tmp = Menu::create([
            'id'        => $routes['language'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoLanguages'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Languages',
            'slug'      => '/languages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['language'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoLanguageEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Edit language',
            'slug'      => '/edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $tmp,
        ]);

        $tmp = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoTranslations'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Translations',
            'slug'      => '/translations',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'   => $menus['language'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoTranslationEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Edit translation',
            'slug'      => '/edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $tmp,
        ]);
    }

}
