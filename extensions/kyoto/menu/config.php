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

    'routes' => [

        'kyoto/menu::domain' => [
            Liro\Web\Menu\Http\Connectors\DomainConnector::class
        ],

        'kyoto/menu::menu' => [
            Liro\Web\Menu\Http\Connectors\MenuConnector::class
        ],

        'kyoto/menu::redirect' => [
            Liro\Web\Menu\Http\Connectors\RedirectConnector::class
        ],

        'kyoto/menu::vue' => [
            Liro\Web\Menu\Http\Connectors\VueConnector::class
        ],

    ],

];
