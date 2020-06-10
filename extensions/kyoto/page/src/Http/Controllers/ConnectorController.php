<?php

namespace Kyoto\Page\Http\Controllers;

use App\Http\Controllers\Controller;

class ConnectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function page()
    {
        return view('kyoto/page::page');
    }

}
