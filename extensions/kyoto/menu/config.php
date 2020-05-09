<?php

return [

    'name'          => 'kyoto/menu',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Web\\Kyoto\\Menu\\' => 'src/'
    ],

    'providers' => [
        \Web\Kyoto\Menu\MenuServiceProvider::class
    ],

    'imports' => [

        'WebMenuTree' => [
            'kyoto/menu::js/web-menu.js'
        ],

        'WebMenuIndex' => [
            'kyoto/menu::js/web-menu.js'
        ],

        'WebMenuEdit' => [
            'kyoto/menu::js/web-menu.js'
        ],

        'WebMenuShow' => [
            'kyoto/menu::js/web-menu.js'
        ]

    ],

];
