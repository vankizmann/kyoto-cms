<?php

return [

    'extensionPath' => 'extensions/*/*/config.php',

    /**
     * Kyoto autoload modules
     */
    'extensionAutoload' => [
        'kyoto/menu'
    ],

    /**
     * Kyoto autoload route inflectors
     */
    'routeInflectors' => [
        \Kyoto\Routing\Routers\ControllerRouter::class
    ],

];
