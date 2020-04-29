<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
//        app('cache')->set('kyoto.locales', ['en', 'de']);

        dump(app('kyoto')->getLocale(), app('kyoto.extension'));

        return view('welcome');
    }
}
