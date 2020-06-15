<?php

return [

    'name'          => 'kyoto/user',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\User\\' => 'src/'
    ],

    'seeds' => [
        UserTableSeeder::class,
    ],

    'providers' => [
        Kyoto\User\UserServiceProvider::class
    ],

    'middleware' => [
        'guarded' => Kyoto\User\Http\Middleware\EnableGuardedMode::class
    ],

    'connectors' => [
//        'login' => \Kyoto\User\Connectors\LoginConnector::class,
//        'logout' => \Kyoto\User\Connectors\LogoutConnector::class
    ],

    'backend' => [
        'kyoto/user::js/index.js',
        'kyoto/user::css/index.css'
    ]

];
