<?php

namespace Kyoto\Menu\Models;

use Kyoto\Support\Database\Model;
use Kyoto\Menu\Models\Traits\Pathable;

class MenuLocale extends Model
{
    use Pathable;

    protected $table = 'menu_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'slug', 'route', 'path'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'slug'          => null,
        'route'         => null,
        'path'          => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'locale'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
    ];

    protected static function boot()
    {
        static::saving(function ($model) {

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->clear();
            }

        });

        parent::boot();
    }

}
