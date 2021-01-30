<?php

return [

    'name'          => 'kyoto/media',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Media\\' => 'src/'
    ],

    'seeds' => [
        MediaTableSeeder::class
    ],

    'providers' => [
        Kyoto\Media\MediaServiceProvider::class
    ],

    'backend' => [
         'kyoto/media::js/index.js',
        // 'kyoto/media::css/index.css'
    ]

];
