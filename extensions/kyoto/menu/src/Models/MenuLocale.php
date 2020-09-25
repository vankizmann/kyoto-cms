<?php

namespace Kyoto\Menu\Models;

use Kyoto\Support\Database\Model;

class MenuLocale extends Model
{
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

}
