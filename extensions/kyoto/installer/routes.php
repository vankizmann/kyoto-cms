<?php

use Illuminate\Support\Facades\Route;

Route::get('/installer/{path?}', 'Web\\Kyoto\\Installer\\Http\\Controllers\\InstallerController@index')
    ->where('path', '.*?');
