<?php

namespace Kyoto\Backend\Connectors;

use Kyoto\Menu\Connectors\ConnectorElement;

class AdminConnector extends ConnectorElement
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
            'uses' => 'Kyoto\Backend\Http\Controllers\ConnectorController@admin'
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
