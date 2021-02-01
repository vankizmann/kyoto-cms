<?php

namespace Kyoto\Page;

use Kyoto\Page\Models\Widget;
use Kyoto\Page\Widgets\HeadlineWidget;
use Kyoto\Page\Widgets\WysiwygWidget;

class WidgetManager {

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

    public function getModelData($model, $data)
    {
        foreach ( $this->loaded as $widget ) {
            if ( $widget->match($model) ) {
               $data = $widget->prototype((array) $data);
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

}
