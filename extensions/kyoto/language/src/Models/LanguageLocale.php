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
        'id'            => 'string',
        'locale'        => 'string',
        'foreign_id'    => 'string',
        'language'      => 'string',
        'country'       => 'string',
    ];

}
