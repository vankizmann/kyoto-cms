<?php

namespace Kyoto\Menu\Http\Controllers;

use App\Http\Controllers\Controller;

class ConnectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function redirect()
    {
        $menu = app('kyoto.menu')->findByUrl();

//        if ( ! app('web.user')->canPolicyDepth($menu) ) {
//            abort(404);
//        }

        return redirect($menu['option']['url'], @$menu['option']['status'] ?: 301);
    }

}
