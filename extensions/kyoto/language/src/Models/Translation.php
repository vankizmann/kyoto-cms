<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Language\Facades\KyotoLanguage;
use Kyoto\Support\Database\Traits\State;
use Kyoto\Support\Database\Traits\Translatable;

class Translation extends Model
{
    use State, Translatable;

    protected $table = 'translations';

    protected $forceDelete = true;

    protected $guarded = [
        'id'
    ];

    protected $localized = [
        'target'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'source'        => null,
        'target'        => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'source'        => 'string',
        'target'        => 'string',
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
