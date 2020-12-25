<?php

namespace Kyoto\Page\Models;

use Kyoto\Menu\Facades\Connector;
use Kyoto\Support\Database\Traits\Translatable;

class Page extends \Kyoto\Support\Database\Model
{
    use Translatable;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'slug', 'content', 'builder', 'guard_id'
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
        static::saved(function ($model) {
            Connector::find('kyoto/page::page')->syncronize($model);
        });

        parent::boot();
    }

    public function getTransactionAttribute()
    {
        return 'kyoto/page::page';
    }

}
