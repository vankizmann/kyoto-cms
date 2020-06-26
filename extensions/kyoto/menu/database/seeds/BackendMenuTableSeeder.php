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
            'title'     => 'kyoto-cms.com',
            'slug'      => ':http://:domain/:locale/backend',
            'guard'     => 1,
            'parent_id' => null,
        ]);


        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Anmelden',
        ]);

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Abmelden',
        ]);

        $routes['dashboard'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['dashboard']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'title'     => 'Redirect',
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

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Seiten',
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

        $menus['page']->localized('de')->update([
            'title'         => 'Seiten',
        ]);

        $temporary = Menu::create([
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

        $temporary->localized('de')->update([
            'title'         => 'Seiten',
        ]);

        $localize = Menu::create([
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
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'         => 'Seite bearbeiten',
        ]);

        $temporary = Menu::create([
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

        $temporary->localized('de')->update([
            'title'         => 'Menüs',
        ]);

        $localize = Menu::create([
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
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'         => 'Menü bearbeiten',
        ]);

        $routes['user'] = uuid();

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Benutzer',
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

        $menus['user']->localized('de')->update([
            'title'         => 'Benutzer',
        ]);

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Benutzer',
        ]);

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Rollen',
        ]);

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Zugänge',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoPolicies'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'title'     => 'Policies',
            'slug'      => '/policies',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $localize->localized('de')->update([
            'title'         => 'Rechte',
        ]);

        $routes['language'] = uuid();

        $localize = Menu::create([
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

        $localize->localized('de')->update([
            'title'         => 'Sprachen',
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

        $menus['language']->localized('de')->update([
            'title'         => 'Sprachen',
        ]);

        $temporary = Menu::create([
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

        $temporary->localized('de')->update([
            'title'         => 'Sprachen',
        ]);

        $localize = Menu::create([
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
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'         => 'Sprache bearbeiten',
        ]);

        $temporary = Menu::create([
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

        $temporary->localized('de')->update([
            'title'         => 'Übersetzungen',
        ]);

        $localize = Menu::create([
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
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'         => 'Übersetzung bearbeiten',
        ]);
    }

}
