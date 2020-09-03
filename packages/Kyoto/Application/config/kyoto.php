<?php

return [

    'extensionPath' => 'extensions/*/*/config.php',

    /**
     * Kyoto autoload modules
     */
    'extensionLoad' => [
        'kyoto/installer',
        'kyoto/language',
        'kyoto/user',
        'kyoto/menu',
        'kyoto/media',
        'kyoto/page',
        'kyoto/backend',
        'kyoto/theme'
    ],

    /**
     * Kyoto autoload route inflectors
     */
    'routeInflectors' => [
        \Kyoto\Routing\Routers\ControllerRouter::class,
        \Kyoto\Menu\Routers\MenuRouter::class
    ],

];
