<?php

namespace Kyoto\Package\Models;

use Kyoto\Support\Database\Traits\Translatable;

class Package extends \Kyoto\Support\Database\Model
{
    use Translatable;

    protected $table = 'packages';

    protected $fillable = [
        'state', 'name'
    ];

    protected $fields = [
        //'config'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'name'          => null
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'boolean',
        'name'          => 'string'
    ];

}
