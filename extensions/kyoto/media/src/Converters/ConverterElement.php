<?php

namespace Kyoto\Media\Converters;

class ConverterElement implements ConverterInterface
{
    /**
     * Does model matches converter type.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return boolean
     */
    public function match($model)
    {
        return false;
    }

    /**
     * On creating event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelCreating($model)
    {
        return $model;
    }

    /**
     * On created event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelCreated($model)
    {
        return $model;
    }

    /**
     * On saving event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaving($model)
    {
        return $model;
    }

    /**
     * On saved event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaved($model)
    {
        return $model;
    }

    /**
     * On deleting event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelDeleting($model)
    {
        return $model;
    }

    /**
     * On deleted event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelDeleted($model)
    {
        return $model;
    }
}
