<?php

namespace Kyoto\Page\Widgets;

class WidgetElement implements WidgetInterface
{
    /**
     * @var string
     */
    public static $type = 'KyoFoobarWidget';

    /**
     * Returns widget info to display
     *
     * @return array
     */
    public function info()
    {
        return [
            'title' => 'Foobar', 'description' => 'No description given'
        ];
    }

    /**
     * Does model matches widget type.
     *
     * @param array
     * @return array
     */
    public function prototype($data)
    {
        return $data;
    }

    /**
     * Does model matches widget type.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return boolean
     */
    public function match($model)
    {
        return $model->type === static::$type;
    }

    /**
     * On creating event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelCreating($model)
    {
        return $model;
    }

    /**
     * On created event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelCreated($model)
    {
        return $model;
    }

    /**
     * On saving event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelSaving($model)
    {
        return $model;
    }

    /**
     * On saved event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelSaved($model)
    {
        return $model;
    }

    /**
     * On deleting event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelDeleting($model)
    {
        return $model;
    }

    /**
     * On deleted event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelDeleted($model)
    {
        return $model;
    }

}
