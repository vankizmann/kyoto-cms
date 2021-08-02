<?php

namespace Kyoto\Page\Models;

use Kyoto\Application\Facades\Kyoto;
use Kyoto\Support\Database\Traits\State;
use Kyoto\Support\Database\Traits\Translatable;

class Widget extends \Kyoto\Support\Database\Model
{
    use Translatable, State;

    protected $table = 'widgets';

    protected $guarded = [
        'id'
    ];

    protected $localized = [
        'data'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'type'          => null,
        'data'          => null
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'type'          => 'string',
        'data'          => 'array'
    ];

    protected static function boot()
    {
        static::creating(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelCreating($model);
            }
        });

        static::created(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelCreated($model);
            }
        });

        static::saving(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelSaving($model);
            }
        });

        static::saved(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelSaved($model);
            }
        });

        static::deleting(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelDeleting($model);
            }
        });

        static::deleted(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->onModelDeleted($model);
            }
        });

        parent::boot();
    }

    public function getDataAttribute()
    {
        return app('kyoto.widget')->getModelData($this, $this->attributes['data']);
    }

}
