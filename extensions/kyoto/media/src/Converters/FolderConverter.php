<?php

namespace Kyoto\Media\Converters;

class FolderConverter extends ConverterElement
{
    /**
     * Does model matches converter type.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return boolean
     */
    public function match($model)
    {
        return in_array($model->type, ['system/folder']);
    }

    /**
     * On deleting event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelDeleting($model)
    {
        foreach ( $model->getLeaves() as $leaf ) {
            $leaf->delete();
        }

        return $model;
    }

}
