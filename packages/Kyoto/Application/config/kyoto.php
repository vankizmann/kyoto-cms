<?php

return [

    'extensionPath' => 'extensions/*/*/config.php',

    /**
     * Kyoto autoload modules
     */
    'extensionLoad' => [
        'kyoto/installer',
        'kyoto/menu'
    ],

    /**
     * Kyoto autoload route inflectors
     */
    'routeInflectors' => [
        \Kyoto\Routing\Routers\ControllerRouter::class,
        \Kyoto\Menu\Routers\MenuRouter::class
    ],

];
