<?php

namespace Kyoto\Media\Models;

use Baum\NestedSet\Node;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Database\Traits\DepthGuarded;
use Kyoto\Support\Database\Traits\Translatable;

class Media extends \Kyoto\Support\Database\Model
{
    use Node, Translatable, DepthGuarded;

    protected $table = 'medias';

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'uid', 'url', 'urls', 'count', 'above'
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
        'view'          => null,
        'type'          => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'title'         => 'string',
        'description'   => 'string',
        'copyright'     => 'string',
        'file'          => 'string',
        'view'          => 'string',
        'type'          => 'string',
    ];

    protected $relationships = [
        'parent', 'children'
    ];


    protected static function boot()
    {
        static::creating(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelCreating($model);
            }
        });

        static::created(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelCreated($model);
            }
        });

        static::saving(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelSaving($model);
            }
        });

        static::saved(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelSaved($model);
            }
        });

        static::deleting(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelDeleting($model);
            }
        });

        static::deleted(function ($model) {

            if ( Kyoto::isReady() ) {
                app('kyoto.media')->onModelDeleted($model);
            }

            if ( strpos($model->file, 'source/') !== false ) {
                app('kyoto.media')->deleteSource($model->file);
            }

            if ( strpos($model->view, 'source/') !== false ) {
                app('kyoto.media')->deleteSource($model->view);
            }

        });

        parent::boot();
    }

    public function getIdAttribute()
    {
        return $this->attributes['id'] ?:
            '00000000-0000-0000-0000-000000000000';
    }

    public function getUidAttribute()
    {
        return uuid();
    }

    public function getTypeAttribute()
    {
        return ! $this->attributes['type'] ? 'system/folder' :
            $this->attributes['type'];
    }

    public function getAboveAttribute()
    {
        if ( $this->type !== 'system/folder' ) {
            return null;
        }

        $above = new self(['title' => trans('Root')]);

        if ( $this->parent_id ) {
            $above = $this->parent;
        }

        return $above->fill(['type' => 'system/above']);
    }

    public function getCountAttribute()
    {
        return $this->type !== 'system/folder' ? null :
            $this->leaves()->count();
    }

    public function getUrlAttribute()
    {
        return Storage::disk('media')->url($this->view);
    }

    public function getUrlsAttribute()
    {
        return app('kyoto.media')->getThumnailUrls($this->view);
    }

}
