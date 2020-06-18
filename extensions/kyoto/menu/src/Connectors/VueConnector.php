<?php

namespace Kyoto\Menu\Connectors;

class VueConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        $baseMenu = $menu->getAncestorsAndSelf()
            ->where('type', '!=', 'kyoto/menu::vue')->first();

        app('kyoto')->setMenu($baseMenu);

        /** @var \Kyoto\Menu\Connectors\ConnectorInterface $connector */
        $connector = app('kyoto.connector')->find($baseMenu['type']);

        if ( ! $connector ) {
            return null;
        }

        return $connector->route($baseMenu);
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
