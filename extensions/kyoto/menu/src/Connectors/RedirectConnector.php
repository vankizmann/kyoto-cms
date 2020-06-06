<?php

namespace Kyoto\Menu\Connectors;

class RedirectConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        if ( ! isset($menu['option']['url']) ) {
            return null;
        }

        return [
            'uses' => 'Kyoto\Menu\Http\Controllers\ConnectorController@redirect'
        ];
    }

    /**
     * Provide options for backend.
     *
     * @return array
     */
    public function options()
    {
        $options = [
            'icon' => 'fa fa-link', 'component' => null, 'links' => []
        ];

        $options['connect'] = [
            'index' => 'WebMenuIndex', 'edit'  => 'WebMenuEdit'
        ];

        return $options;
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
