<?php

namespace Kyoto\Media\Converters;

class ImageConverter extends ConverterElement
{
    /**
     * Does model matches converter type.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return boolean
     */
    public function match($model)
    {
        return in_array($model->type, ['image/jpeg', 'image/png']);
    }

    /**
     * On saving event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaving($model)
    {
        $model->view = $model->file;

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
        app('kyoto.media')->saveThumbnails($model->view);

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
        app('kyoto.media')->deleteThumbnails($model->view);

        return $model;
    }

}
