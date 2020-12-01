<?php

return [

    'name'          => 'kyoto/installer',
    'version'       => '1.0.0',
    'type'          => 'package',

    'autoload' => [
        'Kyoto\\Installer\\' => 'src/'
    ],

    'providers' => [
        Kyoto\Installer\InstallerServiceProvider::class
    ],

];
