<?php

namespace Liro\Web\Menu\Http\Controllers;

use Liro\Support\Routing\RouteHelper;
use Liro\Menu\Routing\Traits\DiscoverMenu;
use App\Http\Controllers\Controller;

class MenuViewController extends Controller
{
    use DiscoverMenu;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(['web']);
    }

    public function getRedirectRoute()
    {
        if ( ! app('web.user')->canPolicyDepth($this->menu) ) {
            abort(404);
        }

        return redirect($this->menu->extend['url'], 301);
    }

    public function anyVueRoute()
    {
        if ( ! app('web.user')->canPolicyDepth($this->menu) ) {

            $loginMenu = app('web.menu')->getDomain()
                ->descendants()->where('type', 'web-auth::login')->first();

            return redirect()->to($loginMenu->path);
        }

        $basePath = RouteHelper::extractRoute(
            $this->menu->getRoot()->path
        );

        return view('web-menu::vue/default', [
            'basePath' => $basePath
        ]);
    }

}
