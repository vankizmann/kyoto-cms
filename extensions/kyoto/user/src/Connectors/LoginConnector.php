<?php

namespace Kyoto\User\Connectors;

use Kyoto\Menu\Connectors\ConnectorElement;

class LoginConnector extends ConnectorElement
{
    /**
     * Provide router options.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
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
