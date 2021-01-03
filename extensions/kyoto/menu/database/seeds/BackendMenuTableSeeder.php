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
            'option'    => ['url' => ':http://:domain/:locale/backend', 'status' => 301],
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Redirect',
            'slug'      => ':http://:domain/backend',
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
            'guard_id'  => env('KYO_GUARD'),
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
            'parent'    => $menus['root'],
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
            'system'    => 1,
            'title'     => 'Redirect',
            'slug'      => '/',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
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
            'guard_id'  => env('KYO_GUARD'),
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
            'guard_id'  => env('KYO_GUARD'),
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['dashboard'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['root'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['page'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['page'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['page'],
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoMediaCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create media',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoMediaEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit media',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['dashboard'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['root'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['user'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['user'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['user'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['user'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['dashboard'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['root'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['language'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['language'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
        ]);

        $routes['product'] = uuid();

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' =>  $routes['product']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Products',
            'slug'      => 'product',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['dashboard'],
        ]);

        $menus['product'] = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['redirect' => $routes['product']],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Products',
            'slug'      => 'products',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['root'],
        ]);

        $temporary = Menu::create([
            'id'        => $routes['product'],
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' => 'KyoProducts'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 0,
            'system'    => 1,
            'title'     => 'Products',
            'slug'      => 'products',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['product'],
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoProductCreate'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Create product',
            'slug'      => 'create',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
        ]);

        $localize = Menu::create([
            'id'        => uuid(),
            'type'      => 'kyoto/menu::vue',
            'option'    => ['component' =>  'KyoProductEdit'],
            'layout'    => null,
            'state'     => 1,
            'hide'      => 1,
            'system'    => 1,
            'title'     => 'Edit product',
            'slug'      => 'edit/:id',
            'matrix'    => 1,
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['dashboard'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['root'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $menus['package'],
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
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
            'guard_id'  => env('KYO_GUARD'),
            'parent'    => $temporary,
        ]);

    }

}
