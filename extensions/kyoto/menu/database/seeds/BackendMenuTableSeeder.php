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
            'system'    => 1,
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
            'system'    => 1,
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
            'system'    => 1,
            'title'     => 'Login',
            'slug'      => 'login',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $menus['root'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Anmelden',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/user::logout',
            'layout'    => 'kyoto/backend::login',
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Logout',
            'slug'      => 'logout',
            'matrix'    => 1,
            'guard'     => 0,
            'parent'    => $menus['root'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Abmelden',
        ]);

        $routes['dashboard'] = uuid();

        Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['dashboard']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
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
            'system'    => 1,
            'title'     => 'Dashboard',
            'slug'      => 'dashboard',
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
            'system'    => 1,
            'title'     => 'Dashboard',
            'slug'      => 'dashboard',
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
            'system'    => 1,
            'title'     => 'Pages',
            'slug'      => 'pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Seiten',
        ]);

        $menus['page'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['page']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Pages',
            'slug'      => 'pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $menus['page']->localized('de')->update([
            'title'     => 'Seiten',
        ]);

        $temporary = Menu::create([
            'id'        => $routes['page'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoPages'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Pages',
            'slug'      => 'pages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['page'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Seiten',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPageCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create page',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Seite erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPageEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit page',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Seite bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoMenus'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Menus',
            'slug'      => 'menus',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['page'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Menüs',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoMenuEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit menu',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Menü bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoMedias'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Medias',
            'slug'      => 'medias',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['page'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Medien',
        ]);

        $routes['user'] = uuid();

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['user']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Users',
            'slug'      => 'users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Benutzer',
        ]);

        $menus['user'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['user']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Users',
            'slug'      => 'users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $menus['user']->localized('de')->update([
            'title'     => 'Benutzer',
        ]);

        $temporary = Menu::create([
            'id'        => $routes['user'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoUsers'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Users',
            'slug'      => 'users',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Benutzer',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoUserCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create user',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Benutzer erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoUserEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit user',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Benutzer bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoRoles'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Roles',
            'slug'      => 'roles',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Rollen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoRoleCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create role',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Rolle erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoRoleEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit role',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Rolle bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoGates'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Gates',
            'slug'      => 'gates',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Zugänge',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoGateCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create gate',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Zugang erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoGateEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit gate',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Zugang bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoPolicies'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Policies',
            'slug'      => 'policies',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['user'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Rechte',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPolicyCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create policy',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Recht erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPolicyEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit policy',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Recht bearbeiten',
        ]);

        $routes['language'] = uuid();

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['language']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Languages',
            'slug'      => 'language',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Sprachen',
        ]);

        $menus['language'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['language']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Languages',
            'slug'      => 'languages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $menus['language']->localized('de')->update([
            'title'     => 'Sprachen',
        ]);

        $temporary = Menu::create([
            'id'        => $routes['language'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoLanguages'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Languages',
            'slug'      => 'languages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['language'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Sprachen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoLanguageCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create language',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Sprache erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoLanguageEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit language',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Sprache bearbeiten',
        ]);

        $temporary = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoTranslations'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Translations',
            'slug'      => 'translations',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['language'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Übersetzungen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoTranslationCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create translation',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Übersetzung erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoTranslationEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit translation',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Übersetzung bearbeiten',
        ]);

        $routes['package'] = uuid();

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['package']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Packages',
            'slug'      => 'package',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['dashboard'],
        ]);

        $localize->localized('de')->update([
            'title'     => 'Erweiterungen',
        ]);

        $menus['package'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['package']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Packages',
            'slug'      => 'packages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['root'],
        ]);

        $menus['package']->localized('de')->update([
            'title'     => 'Erweiterungen',
        ]);

        $temporary = Menu::create([
            'id'        => $routes['package'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoPackages'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Packages',
            'slug'      => 'packages',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $menus['package'],
        ]);

        $temporary->localized('de')->update([
            'title'     => 'Erweiterungen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPackageCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create package',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Erweiterung erstellen',
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoPackageEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit package',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard'     => 1,
            'parent'    => $temporary,
        ]);

        $localize->localized('de')->update([
            'title'     => 'Erweiterung bearbeiten',
        ]);
    }

}
