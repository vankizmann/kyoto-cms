<?php

namespace Kyoto\Page\Widgets;

interface WidgetInterface
{
    /**
     * Returns widget info to display
     *
     * @return array
     */
    public function info();

    /**
     * Convert model data to prototyped object.
     *
     * @param array
     * @return array
     */
    public function prototype($data);

    /**
     * Does model matches widget type.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return boolean
     */
    public function match($model);

    /**
     * On creating event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelCreating($model);

    /**
     * On created event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelCreated($model);

    /**
     * On saving event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelSaving($model);

    /**
     * On saved event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelSaved($model);

    /**
     * On deleting event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelDeleting($model);

    /**
     * On deleted event.
     *
     * @param \Kyoto\Page\Models\Widget $model
     * @return \Kyoto\Page\Models\Widget $model
     */
    public function onModelDeleted($model);

}
