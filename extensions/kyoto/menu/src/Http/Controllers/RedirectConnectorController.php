<?php

namespace Kyoto\Menu\Http\Controllers;

use App\Http\Controllers\Controller;

class RedirectConnectorController extends Controller
{
    public function index()
    {
        return redirect(app('kyoto')->getMenu('option.url'),
            app('kyoto')->getMenu('option.status', 301));
    }

}
