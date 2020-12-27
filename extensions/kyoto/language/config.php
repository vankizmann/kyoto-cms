<?php

return [

    'name'          => 'kyoto/language',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Language\\' => 'src/'
    ],

    'seeds' => [
        LanguageTableSeeder::class,
        TranslationTableSeeder::class
    ],

    'providers' => [
        Kyoto\Language\LanguageServiceProvider::class
    ],

    'backend' => [
        'kyoto/language::js/index.js',
        'kyoto/language::css/index.css'
    ]

];
