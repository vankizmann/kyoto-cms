<?php

namespace Kyoto\Page\Connectors;

use Illuminate\Support\Str;
use Kyoto\Menu\Connectors\ConnectorElement;

class PageConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
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
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return array
     */
    public function options($menu)
    {
        return [
            'edit' => [
                'name' => 'KyoPageEdit', 'params' => ['id' => $menu->getOption('page_id')]
            ]
        ];
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @param array $data
     * @return mixed
     */
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
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function provide($menu)
    {
        return null;
    }

    /**
     * Collect data for menu rendering.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function collect($menu)
    {
        return null;
    }

}
