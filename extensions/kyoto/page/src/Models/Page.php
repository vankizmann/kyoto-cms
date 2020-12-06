<?php

namespace Kyoto\Page\Models;

use Kyoto\Support\Database\Traits\Translatable;

class Page extends \Kyoto\Support\Database\Model
{
    use Translatable;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'content', 'builder', 'guard_id'
    ];

    protected $appends = [
        'transaction'
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
        'slug'          => null,
        'content'       => null,
        'builder'       => null
    ];

    protected $casts = [
        'id'            => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'content'       => 'string',
        'builder'       => 'array'
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

    public function getTransactionAttribute()
    {
        return 'kyoto/page::page';
    }

}
