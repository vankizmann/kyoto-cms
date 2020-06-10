<?php

return [

    'name'          => 'kyoto/page',
    'version'       => '1.0.0',
    'type'          => 'theme',

    'autoload' => [
        'Kyoto\\Page\\' => 'src/'
    ],

    'connectors' => [
        'page' => \Kyoto\Page\Connectors\PageConnector::class
    ]

];
