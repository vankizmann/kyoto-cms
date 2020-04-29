<?php

namespace Liro\Web\Menu\Http\Connectors;

use Liro\Menu\Routing\Connector;
use Liro\Support\Routing\RouteHelper;
use App\Database\Menu;

class VueConnector extends Connector
{
    /**
     * Provide router options.
     *
     * @param \App\Database\Menu $menu
     * @param array $options
     * @return void
     */
    public function route(Menu $menu, $options)
    {
        if ( strpos(':', $options['route']) ) {
            $options['route'] = preg_replace('/:([^\/]+)/', '{$1}', $options['route']);
        }

        app('router')->any($options['route'], array_merge($options, [
            'uses' => 'Liro\Web\Menu\Http\Controllers\MenuViewController@anyVueRoute'
        ]));
    }

    /**
     * Provide options for backend.
     *
     * @return array
     */
    public function options()
    {
        $options = [
            'icon' => 'fab fa-vuejs', 'component' => null, 'links' => []
        ];

        $options['connect'] = [
            'index' => 'WebMenuIndex', 'edit'  => 'WebMenuEdit'
        ];

        return $options;
    }

    /**
     * Provide data for view.
     *
     * @param \App\Database\Menu $menu
     * @return array|bool
     */
    public function provide(Menu $menu)
    {
        return false;
    }

    /**
     * Collect data for menu rendering.
     *
     * @param \App\Database\Menu $menu
     * @return array|bool
     */
    public function collect(Menu $menu)
    {
        return false;
    }
}
