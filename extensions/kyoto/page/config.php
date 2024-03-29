<?php

return [

    'name'          => 'kyoto/page',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Page\\' => 'src/'
    ],

    'seeds' => [
        PageTableSeeder::class
    ],

    'providers' => [
        Kyoto\Page\PageServiceProvider::class
    ],

    'connectors' => [
        'page' => \Kyoto\Page\Connectors\PageConnector::class
    ],

    'backend' => [
        'kyoto/page::js/index.js',
         'kyoto/page::css/index.css'
    ]

];
