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
        return redirect(app('kyoto')->getMenu('option.url'), app('kyoto')->getMenu('option.status', 301));
    }

}
