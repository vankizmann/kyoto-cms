<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;

class LanguageLocale extends Model
{
    protected $table = 'language_locales';

    protected $fillable = [
        'id', 'locale', 'foreign_id', 'language', 'country'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'foreign_id'    => null,
        'language'      => null,
        'country'       => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'locale'        => 'string',
        'foreign_id'    => 'uuid',
        'language'      => 'string',
        'country'       => 'string',
    ];

}
