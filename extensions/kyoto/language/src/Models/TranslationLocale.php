<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;

class TranslationLocale extends Model
{
    protected $table = 'translation_locales';

    protected $fillable = [
        'id', 'locale', 'foreign_id', 'target'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'foreign_id'    => null,
        'target'        => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'locale'        => 'string',
        'foreign_id'    => 'string',
        'target'        => 'string',
    ];

}
