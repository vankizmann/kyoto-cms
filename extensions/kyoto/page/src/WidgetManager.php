<?php

namespace Kyoto\Page;

use Kyoto\Page\Models\Widget;
use Kyoto\Page\Widgets\HeadlineWidget;
use Kyoto\Page\Widgets\WysiwygWidget;

class WidgetManager
{

    public $loaded = [
        //
    ];

    public function __construct()
    {
        $this->add(HeadlineWidget::class);
        $this->add(WysiwygWidget::class);
    }

    public function add($widget)
    {
        $this->loaded[$widget::$type] = new $widget;
    }

    public function onModelCreating($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelCreating($model);
            }
        }

        return $model;
    }

    public function onModelCreated($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelCreated($model);
            }
        }

        return $model;
    }

    public function onModelSaving($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelSaving($model);
            }
        }

        return $model;
    }

    public function onModelSaved($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelSaved($model);
            }
        }

        return $model;
    }

    public function onModelDeleting($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelDeleting($model);
            }
        }

        return $model;
    }


    public function onModelDeleted($model)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $model = $widget->onModelDeleted($model);
            }
        }

        return $model;
    }

    public function getModelData($model, $data = null)
    {
        if ( is_string($data) ) {
            $data = json_decode($data, true);
        }

        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
                $data = $widget->prototype($data ?: []);
            }
        }

        return $data;
    }

    public function getWidgets()
    {
        $widgets = [];

        foreach ( $this->loaded as $type => $widget ) {

            $node = new Widget(['type' => $type]);

            $widgets[$type] = array_merge($widget->info(),
                ['node' => $node]);
        }

        return $widgets;
    }

    public function saveWidgets($unique, $widgets = [])
    {
        foreach ( $widgets as $index => $widget ) {

            $condition = [
                'id' => $widget['id']
            ];

            $data = array_merge([
                'sequence'  => $index,
                'source_id' => $unique,
            ], $widget);

            Widget::firstOrNew($condition)->fill($data)->save();
        }

        return $this;
    }

    public function fetchWidgets($unique)
    {
        $results = [];

        $widgets = Widget::where('source_id', $unique)
            ->orderBy('sequence', 'asc')->get();

        foreach ( $widgets as $widget ) {
            $results[] = $widget;
        }

        return $results;
    }

    public function deleteWidgets($unique)
    {
        Widget::where('source_id', $unique)
            ->orderBy('sequence', 'asc')->delete();
    }

}
