<?php

use Illuminate\Database\Seeder;
use App\Database\Menu;

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
            'type'      => 'web-menu::redirect',
            'layout'    => null,
            'extend'    => ['url' => ':http://:domain/:locale/backend'],
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
            'type'      => 'web-menu::domain',
            'layout'    => 'web-backend::default',
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'liro-cms.com',
            'slug'      => ':http://:domain/:locale/backend',
            'guard'     => 0,
            'parent_id' => null,
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'web-auth::login',
            'layout'    => 'web-backend::login',
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
            'type'      => 'web-auth::logout',
            'layout'    => 'web-backend::login',
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
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' => $routes['dashboard']],
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
            'id'        => $routes['dashboard'],
            'type'      => 'web-menu::vue',
            'icon'      => 'web-dashboard::img/icon-dashboard.svg',
            'extend'    => ['component' => 'WebDashboardIndex'],
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
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' => $routes['dashboard']],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' => $routes['page']],
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
            'id'        => $routes['page'],
            'type'      => 'web-menu::vue',
            'icon'      => 'web-page::img/icon-page.svg',
            'extend'    => ['component' => 'WebPageIndex'],
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
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' =>  $routes['page']],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['component' =>  'WebPageEdit'],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['component' => 'WebMenuIndex'],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['component' =>  'WebMenuEdit'],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' => $routes['user']],
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
            'id'        => $routes['user'],
            'type'      => 'web-menu::vue',
            'icon'      => 'web-user::img/icon-user.svg',
            'extend'    => ['component' => 'WebUserIndex'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Users',
            'slug'      => '/users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $tmp = Menu::create([
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' =>  $routes['user']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Users',
            'slug'      => '/users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $routes['language'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' => $routes['language']],
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
            'id'        => $routes['language'],
            'type'      => 'web-menu::vue',
            'icon'      => 'web-language::img/icon-language.svg',
            'extend'    => ['component' => 'WebLanguageIndex'],
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
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['redirect' =>  $routes['language']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Languages',
            'slug'      => '/languages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent_id' => $routes['language'],
        ]);

        Menu::create([
            'id'        => uuid(),
            'type'      => 'web-menu::vue',
            'extend'    => ['component' =>  'WebLanguageEdit'],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['component' => 'WebTranslationIndex'],
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
            'type'      => 'web-menu::vue',
            'extend'    => ['component' =>  'WebTranslationEdit'],
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
