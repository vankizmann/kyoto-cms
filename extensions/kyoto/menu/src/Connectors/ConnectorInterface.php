<?php

namespace Kyoto\Menu\Connectors;

interface ConnectorInterface
{
    /**
     * Provide router options.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu);

    /**
     * Collect data for menu rendering.
     *
     * @param \Kyoto\Menu\Models\Menu $target
     * @param \Kyoto\Support\Database\Model $source
     * @return \Kyoto\Menu\Models\Menu
     */
    public function transaction($target, $source);

    /**
     * Collect source for source rendering.
     *
     * @param \Kyoto\Menu\Models\Menu $target
     * @param \Kyoto\Support\Database\Model $source
     * @return \Kyoto\Menu\Models\Menu
     */
    public function syncronize($source);

    /**
     * Provide options for backend.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return array
     */
    public function options($menu);

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function provide($menu);

    /**
     * Collect data for menu rendering.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function collect($menu);
}
