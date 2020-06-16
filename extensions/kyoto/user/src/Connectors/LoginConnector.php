<?php

namespace Kyoto\User\Connectors;

use Kyoto\Menu\Connectors\ConnectorElement;

class LoginConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param array|\Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        $action = 'login';

        if ( request()->isMethod('post') ) {
            $action = 'postLogin';
        }

        return [
            'uses' => "Kyoto\User\Http\Controllers\ConnectorController@{$action}"
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
