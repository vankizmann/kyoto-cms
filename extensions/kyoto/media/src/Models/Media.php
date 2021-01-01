<?php

namespace Kyoto\Media\Models;

use Baum\NestedSet\Node;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Kyoto\User\Database\Traits\DepthGuarded;
use Kyoto\Support\Database\Traits\Translatable;

class Media extends \Kyoto\Support\Database\Model
{
    use Node, Translatable, DepthGuarded;

    protected $table = 'medias';

    protected $transform = [

        'square/sm' => [480, 480],
        'square/md' => [960, 960],
        'square/lg' => [1440, 1440],

        'landscape/sm' => [640, 360],
        'landscape/md' => [1280, 720],
        'landscape/lg' => [1920, 1080],
    ];

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'name', 'url', 'urls', 'above'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'description', 'copyright'
    ];

    protected $attributes = [
        'id'            => null,
        'title'         => null,
        'description'   => null,
        'copyright'     => null,
        'file'          => null,
        'type'          => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'title'         => 'string',
        'description'   => 'string',
        'copyright'     => 'string',
        'file'          => 'string',
        'type'          => 'string',
    ];

    protected $relationships = [
        'parent', 'children'
    ];


    protected static function boot()
    {
        static::saved(function ($model) {

            if ( $model->type === 'image/jpeg' ) {
                foreach ( $model->transform as $folder => $sizes ) {
                    $model->saveResized($model, $folder, $sizes, 'jpg');
                }
            }

            if ( $model->type === 'image/png' ) {
                foreach ( $model->transform as $folder => $sizes ) {
                    $model->saveResized($model, $folder, $sizes, 'png');
                }
            }
        });

        static::deleting(function ($model) {
            if ( $model->type === 'system/folder' ) {
                $model->deleteLeaves($model);
            }
        });

        static::deleted(function ($model) {

            foreach ( array_keys($model->transform ) as $folder ) {
                $model->deleteResized($model, $folder);
            }

            Storage::disk('media')->delete($model->file);
        });

        parent::boot();
    }

    public function saveResized($model, $folder, $sizes, $type)
    {
        $file = Storage::disk('media')->get($model->file);

        $image = Image::make($file);

        $image->fit($sizes[0], $sizes[1], function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('media')->put(str_join('/', $folder, $model->name),
            $image->stream($type, 75));
    }

    public function deleteResized($model, $folder)
    {
        $fileName = str_join('/', $folder, $model->name);

        Storage::disk('media')->delete($fileName);
    }

    public function deleteLeaves($model)
    {
        foreach ( $model->getDescendants()->all() as $leaf ) {
            $leaf->delete();
        }
    }

    public function getAboveAttribute()
    {
        if ( ! $this->id || $this->type !== 'system/folder' ) {
            return null;
        }

        $above = new self(['title' => trans('Root')]);

        if ( $this->parent_id ) {
            $above = $this->parent;
        }

        return $above->fill(['type' => 'system/above']);
    }

    public function getNameAttribute()
    {
        return pathinfo($this->file, PATHINFO_BASENAME);
    }

    public function getUrlAttribute()
    {
        return Storage::disk('media')->url($this->file);
    }

    public function getUrlsAttribute()
    {
        $urls = [];

        foreach ( array_keys($this->transform) as $folder ) {
            $urls[$folder] = Storage::disk('media')
                ->url(str_join('/', $folder, $this->name));
        }

        return $urls;
    }

    public function toArray()
    {
        $attributes = $this->attributesToArray(false);

        foreach ( $this->appends as $key ) {
            if ( $this->hasGetMutator($key) ) {
                $attributes[$key] = $this->{'get' . Str::studly($key) . 'Attribute'}($key);
            }
        }

        foreach ( array_keys($this->relations) as $key ) {
            $attributes[$key] = $this->getRelation($key)->toArray();
        }

        return $attributes;
    }

}
