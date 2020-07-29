<?php

return [

    'name'          => 'kyoto/page',
    'version'       => '1.0.0',
    'type'          => 'theme',

    'autoload' => [
        'Kyoto\\Page\\' => 'src/'
    ],

    'seeds' => [
        PageTableSeeder::class
    ],

    'connectors' => [
        'page' => \Kyoto\Page\Connectors\PageConnector::class
    ],

    'backend' => [
        'kyoto/page::js/index.js',
        'kyoto/page::css/index.css'
    ]

];
