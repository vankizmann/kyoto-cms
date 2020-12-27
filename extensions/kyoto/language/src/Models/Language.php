<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Language\Facades\KyotoLanguage;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;
use Kyoto\Support\Database\Traits\Translatable;

class Language extends Model
{
    use State, Hide, Translatable;

    protected $table = 'languages';

    protected $forceDelete = true;

    protected $guarded = [
        'id'
    ];

    protected $localized = [
        'language', 'country'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'hide'          => null,
        'language'      => null,
        'country'       => null,
        'locale'        => null,
        'plate'         => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'hide'          => 'integer',
        'language'      => 'string',
        'country'       => 'string',
        'locale'        => 'string',
        'plate'         => 'string',
    ];

    protected static function boot()
    {
        static::saved(function () {
            if ( Kyoto::isReady() ) {
                KyotoLanguage::clearLanguages();
            }
        });

        parent::boot();
    }

}
