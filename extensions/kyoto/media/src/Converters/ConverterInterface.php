<?php

namespace Kyoto\Media\Converters;

interface ConverterInterface
{
    /**
     * Does model matches converter type.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return boolean
     */
    public function match($model);

    /**
     * On creating event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelCreating($model);

    /**
     * On created event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelCreated($model);

    /**
     * On saving event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaving($model);

    /**
     * On saved event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaved($model);

    /**
     * On deleting event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelDeleting($model);

    /**
     * On deleted event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelDeleted($model);
}
