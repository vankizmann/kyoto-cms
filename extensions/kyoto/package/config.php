<?php

return [

    'name'          => 'kyoto/package',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Package\\' => 'src/'
    ],

    'seeds' => [
        PackageTableSeeder::class,
    ],

    'backend' => [
         'kyoto/package::js/index.js',
        // 'kyoto/package::css/index.css'
    ]

];
