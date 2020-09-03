<?php

namespace Kyoto\Media\Models;

use Kyoto\Support\Database\Model;

class MediaLocale extends Model
{
    protected $table = 'media_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'description'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'description'   => null
    ];

    protected $casts = [
        'id'            => 'uuid',
        'locale'        => 'string',
        'title'         => 'string',
        'description'   => 'string',
    ];

}
