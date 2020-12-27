<?php

namespace Kyoto\Page\Connectors;

use Kyoto\Application\Facades\Kyoto;
use Kyoto\Page\Models\Page;
use Kyoto\Menu\Connectors\ConnectorElement;
use Kyoto\Support\Database\Traits\Translatable;

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
            'uses' => 'Kyoto\Page\Http\Controllers\PageConnectorController@page'
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
     * @param \Kyoto\Menu\Models\Menu $target
     * @param Kyoto\Page\Models\Page $source
     * @return mixed
     */
    public function transaction($target, $source)
    {
        if ( ! is_a($source, Page::class) ) {
            $source = Page::findOrFail($source['id']);
        }

        $this->fill($target, $source);

        if ( ! in_array(Translatable::class, class_uses($source)) ) {
            return $target;
        }

        foreach ( $source->getTranslations() as $translation ) {
            $this->fill($target, $translation);
        }

        return $target;
    }

    /**
     * Provide data for view.
     *
     * @param \Kyoto\Menu\Models\Menu $target
     * @param Kyoto\Page\Models\Page $source
     * @return mixed
     */
    protected function fill($target, $source)
    {
        if ( isset($source->locale) ) {
            $target = $target->getFirstOrNewTranslation($source->locale);
        }

        $target->cloneAttributes($source, ['state', 'hide', 'title', 'slug']);

        if ( $target->isMenuEntity() ) {
            $target->setAttribute('foreign_id', $source->id);
        }

        return $target;
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
