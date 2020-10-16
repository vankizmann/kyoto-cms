<?php

namespace Kyoto\Page\Models;

use Kyoto\Support\Database\Traits\Translatable;

class Page extends \Kyoto\Support\Database\Model
{
    use Translatable;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'content', 'guard_id'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'content'
    ];

    protected $attributes = [
        'id'            => null,
        'title'         => null,
        'content'       => null
    ];

    protected $casts = [
        'id'            => 'string',
        'title'         => 'string',
        'content'       => 'string'
    ];

    protected static function boot()
    {
        static::saving(function () {

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->clear();
            }

        });

        parent::boot();
    }

}
