<?php

namespace Kyoto\Media;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Kyoto\Media\Converters\ImageConverter;
use Kyoto\Media\Converters\FolderConverter;
use Kyoto\Media\Converters\YoutubeConverter;

class MediaManager {

    const MEDIA_STORE = 'media';

    protected $thumbs = [

        'square/sm' => [480, 480, 75],
        'square/md' => [960, 960, 75],
        'square/lg' => [1440, 1440, 75],

        'landscape/sm' => [640, 360, 75],
        'landscape/md' => [1280, 720, 75],
        'landscape/lg' => [1920, 1080, 75],
    ];

    public $loaded = [
        //
    ];

    public function __construct()
    {
        $this->add(FolderConverter::class);
        $this->add(ImageConverter::class);
        $this->add(YoutubeConverter::class);
    }

    public function add($converter)
    {
        $this->loaded[] = new $converter;
    }

    public function onModelCreating($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelCreating($model);
            }
        }

        return $model;
    }

    public function onModelCreated($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelCreated($model);
            }
        }

        return $model;
    }


    public function onModelSaving($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelSaving($model);
            }
        }

        return $model;
    }


    public function onModelSaved($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelSaved($model);
            }
        }

        return $model;
    }


    public function onModelDeleting($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelDeleting($model);
            }
        }

        return $model;
    }


    public function onModelDeleted($model)
    {
        foreach ( $this->loaded as $converter ) {
            if ( $converter->match($model) ) {
                $model = $converter->onModelDeleted($model);
            }
        }

        return $model;
    }

    public function getStore()
    {
        return Storage::disk(self::MEDIA_STORE);
    }

    public function getStoreName()
    {
        return self::MEDIA_STORE;
    }

    public function saveThumbnails($file)
    {
        foreach ( $this->thumbs as $folder => $sizes ) {
            $this->saveThumbnail($file, $folder, $sizes);
        }

        return $this;
    }

    public function saveThumbnail($file, $folder, $sizes, $type = null)
    {
        $binary = $this->getStore()
            ->get($file);

        $image = Image::make($binary);

        $image->fit($sizes[0], $sizes[1], function ($constraint) {
            $constraint->aspectRatio();
        });

        $name = pathinfo($file, PATHINFO_BASENAME);

        $this->getStore()->put(
            str_join('/', $folder, $name), $image->stream($type, $sizes[2]));

        return $this;
    }

    public function deleteThumbnails($file)
    {
        foreach ( array_keys($this->thumbs) as $folder ) {
            $this->deleteThumbnail($file, $folder);
        }

        return $this;
    }

    public function deleteThumbnail($file, $folder)
    {
        $name = pathinfo($file, PATHINFO_BASENAME);

        $this->getStore()->delete(str_join('/', $folder, $name));

        return $this;
    }

    public function getThumnailUrls($file)
    {
        $urls = [];

        if ( empty($file) ) {
            return $urls;
        }

        foreach ( array_keys($this->thumbs) as $folder ) {
            $urls[$folder] = $this->getStore()->url(str_join('/',
                $folder, pathinfo($file, PATHINFO_BASENAME)));
        }

        return $urls;
    }

    public function deleteSource($file)
    {
        Storage::disk(self::MEDIA_STORE)->delete($file);
    }

}
