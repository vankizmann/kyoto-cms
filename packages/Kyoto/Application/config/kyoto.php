<?php

return [

    'extensionPath' => 'extensions/*/*/config.php',

    /**
     * Kyoto autoload modules
     */
    'extensionLoad' => [
        'kyoto/installer'
    ],

    /**
     * Kyoto autoload route inflectors
     */
    'routeInflectors' => [
        \Kyoto\Routing\Routers\ControllerRouter::class
    ],

];
