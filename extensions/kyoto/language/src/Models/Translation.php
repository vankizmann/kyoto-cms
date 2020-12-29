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
        'package'       => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'source'        => 'string',
        'target'        => 'string',
        'package'       => 'string',
    ];

    protected static function boot()
    {
        static::saved(function () {
            if ( Kyoto::isReady() ) {
                KyotoLanguage::clearTranslations();
            }
        });

        parent::boot();
    }

    public function getStateAttribute()
    {
        return ! isset($this->attributes['state']) ?
            1 : $this->attributes['state'];
    }

    public function getPackageAttribute()
    {
        return ! isset($this->attributes['package']) ?
            'app' : $this->attributes['package'];
    }

}
