<?php

namespace Kyoto\Menu\Connectors;

class ConnectorElement implements ConnectorInterface
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        return null;
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
     * @return mixed
     */
    public function provide($menu)
    {
        return null;
    }

    /**
     * Collect data for menu rendering.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function collect($menu)
    {
        return null;
    }

}
