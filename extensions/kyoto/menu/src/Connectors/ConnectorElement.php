<?php

namespace Kyoto\Menu\Connectors;

use Kyoto\Menu\Models\Menu;

class ConnectorElement implements ConnectorInterface
{
    /**
     * Provide router options.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @return mixed
     */
    public function route($menu)
    {
        return null;
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
                'name' => 'KyoMenuEdit', 'params' => ['id' => $menu->id]
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
    public function transaction($menu, $data)
    {
        return $menu;
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Support\Database\Model $source
     * @return mixed
     */
    public function sync($source)
    {
        $menus = Menu::where('foreign_id', $source->id)
            ->where('type', $source->transaction)->get();

        foreach ( $menus as $menu ) {
            $this->transaction($menu, $source)->save();
        }

        return $this;
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Support\Database\Model $source
     * @return mixed
     */
    public function unsync($source)
    {
        $menus = Menu::where('foreign_id', $source->id)
            ->where('type', $source->transaction)->get();

        foreach ( $menus as $menu ) {
            $menu->delete();
        }

        return $this;
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
