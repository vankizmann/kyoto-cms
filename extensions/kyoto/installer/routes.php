<?php

use Illuminate\Support\Facades\Route;

Route::get('/installer/{path?}', 'Kyoto\\Installer\\Http\\Controllers\\InstallerController@index')
    ->where('path', '.*?');
