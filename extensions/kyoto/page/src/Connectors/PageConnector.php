<?php

namespace Kyoto\Page\Connectors;

use Illuminate\Support\Str;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Models\Menu;
use Kyoto\Page\Models\Page;
use Kyoto\Menu\Connectors\ConnectorElement;

class PageConnector extends ConnectorElement
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
            'uses' => 'Kyoto\Page\Http\Controllers\ConnectorController@page'
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
        return [
            'edit' => [
                'name' => 'KyoPageEdit', 'params' => ['id' => $menu->foreign_id]
            ]
        ];
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Menu\Models\Menu $menu
     * @param Kyoto\Page\Models\Page|array $data
     * @return mixed
     */
    public function transaction($menu, $source)
    {
        if ( ! is_a($source, Page::class) ) {
            $source = Page::findOrFail($source['id']);
        }

        $menu->setAttribute('title', $source->title);

        if ( ! $menu->exists && empty($menu->slug) ) {
            $menu->setAttribute('slug', Str::slug($menu->title));
        }

        $menu->setAttribute('foreign_id', $source->id);

        return $menu;
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Page\Models\Page $source
     * @return mixed
     */
    public function syncronize($source)
    {
        $menus = Menu::where('foreign_id', $source->id)
            ->where('type', 'kyoto/page::page')->get();

        foreach ( $menus as $menu ) {
            $this->transaction($menu, $source)->save();
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
