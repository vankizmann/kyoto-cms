<?php

namespace Kyoto\Page\Models;

use Illuminate\Support\Str;
use Kyoto\Support\Database\Model;

class WidgetLocale extends Model
{
    protected $table = 'widget_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'data'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'data'          => null
    ];

    protected $casts = [
        'id'            => 'string',
        'locale'        => 'string',
        'data'          => 'string'
    ];

}
