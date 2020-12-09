<?php

namespace Kyoto\Backend\Connectors;

use Kyoto\Menu\Connectors\ConnectorElement;

class AdminConnector extends ConnectorElement
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
            'uses' => 'Kyoto\Backend\Http\Controllers\ConnectorController@admin'
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
        return parent::options($menu);
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @param array $data
     * @return mixed
     */
    public function transaction($menu, $data)
    {
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
