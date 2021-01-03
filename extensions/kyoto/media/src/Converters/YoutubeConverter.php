<?php

namespace Kyoto\Media\Converters;

use Exception;
use Illuminate\Support\Facades\Storage;

class YoutubeConverter extends ConverterElement
{
    /**
     * Youtube v3 API
     */
    const API_URL = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=%s&key=%s';

    /**
     * Does model matches converter type.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return boolean
     */
    public function match($model)
    {
        return in_array($model->type, ['video/youtube']);
    }

    /**
     * On saving event.
     *
     * @param \Kyoto\Media\Models\Media $model
     * @return \Kyoto\Media\Models\Media $model
     */
    public function onModelSaving($model)
    {
        $api = 'AIzaSyCwI8wood0aumUfBBaTpuZwvIa-jK18094';

        if ( empty($api) ) {
            throw new Exception('Youtube API Key is required');
        }

        $response = json_decode(file_get_contents(
            sprintf(static::API_URL, $model->file, $api)
        ));

        $item = data_get($response, 'items.0.snippet');

        if ( empty($item) ) {
            throw new Exception('Youtube response is not valid');
        }

        $model->title = data_get($item, 'title');

        $thumbnail = data_get($item, 'thumbnails.maxres.url');

        if ( empty($thumbnail) ) {
            throw new Exception('Youtube does not provide an image');
        }

        $model->view = "source/{$model->id}.jpg";

        app('kyoto.media')->getStore()->put($model->view,
            file_get_contents($thumbnail));

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
