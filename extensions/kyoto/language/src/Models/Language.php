<?php

namespace Kyoto\Language\Models;

use Kyoto\Support\Database\Model;
use Kyoto\Support\Database\Traits\Translatable;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;

class Language extends Model
{
    use State, Hide, Translatable;

    protected $table = 'languages';

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
        'id'            => 'uuid',
        'state'         => 'integer',
        'hide'          => 'integer',
        'language'      => 'string',
        'country'       => 'string',
        'locale'        => 'string',
        'plate'         => 'string',
    ];

}
