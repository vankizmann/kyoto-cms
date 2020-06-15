<?php

namespace Kyoto\Backend\Http\Controllers;

use App\Http\Controllers\Controller;

class ConnectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web', 'guarded']);
    }

    public function admin()
    {
        return view('kyoto/backend::admin');
    }

}
