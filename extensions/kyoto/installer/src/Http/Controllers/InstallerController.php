<?php

namespace Web\Kyoto\Installer\Http\Controllers;

use App\Http\Controllers\Controller;

class InstallerController extends Controller
{
    public function index()
    {
        return view('kyoto/installer::default');
    }
}
