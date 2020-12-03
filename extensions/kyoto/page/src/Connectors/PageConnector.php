<?php

namespace Kyoto\Page\Connectors;

use Illuminate\Support\Str;
use Kyoto\Menu\Connectors\ConnectorElement;

class PageConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        return [
            'uses' => 'Kyoto\Page\Http\Controllers\ConnectorController@page'
        ];
    }

    /**
     * Provide options for backend.
     *
     * @return array
     */
    public function options()
    {
        return [];
    }

    public function transaction($menu, $page)
    {
        $menu->setAttribute('title', $page['title']);

        if ( empty($menu->slug) ) {
            $menu->setAttribute('slug', Str::slug($menu->title));
        }

        $menu->setOption('page_id', $page['id']);

        return $menu;
    }

    /**
     * Provide data for view.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return array|bool
     */
    public function provide($menu)
    {
        return false;
    }

    /**
     * Collect data for menu rendering.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return array|bool
     */
    public function collect($menu)
    {
        return false;
    }
}
