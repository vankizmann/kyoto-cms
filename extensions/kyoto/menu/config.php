<?php

return [

    'name'          => 'kyoto/menu',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Menu\\' => 'src/'
    ],

    'seeds' => [
        BackendMenuTableSeeder::class,
        FrontendMenuTableSeeder::class
    ],

    'providers' => [
        Kyoto\Menu\MenuServiceProvider::class
    ],

    'connectors' => [
        'redirect' => \Kyoto\Menu\Connectors\RedirectConnector::class
    ]

];
