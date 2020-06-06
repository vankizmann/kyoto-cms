<?php

namespace Kyoto\Menu\Connectors;

interface ConnectorInterface
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu);

    /**
     * Provide data for view.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function provide($menu);

    /**
     * Collect data for menu rendering.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function collect($menu);
}
