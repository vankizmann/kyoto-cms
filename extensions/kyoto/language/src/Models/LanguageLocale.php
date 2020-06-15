<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;

class LanguageLocale extends Model
{
    protected $table = 'language_locales';

    protected $fillable = [
        'id', 'foreign_id', 'language', 'country'
    ];

    protected $attributes = [
        'id'            => null,
        'foreign_id'    => null,
        'language'      => null,
        'country'       => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'foreign_id'    => 'uuid',
        'language'      => 'string',
        'country'       => 'string',
    ];

}
