<?php

return [

    'name'          => 'kyoto/backend',
    'version'       => '1.0.0',
    'type'          => 'admin',

    'autoload' => [
        'Kyoto\\Backend\\' => 'src/'
    ],

    'providers' => [
        \Kyoto\Backend\BackendServiceProvider::class
    ],

    'connectors' => [
        'admin' => \Kyoto\Backend\Connectors\AdminConnector::class
    ]

];
