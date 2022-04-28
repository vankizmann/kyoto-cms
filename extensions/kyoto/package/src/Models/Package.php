<?php

namespace Kyoto\Package\Models;

class Package extends \Kyoto\Support\Database\Model
{
    protected $table = 'packages';

    protected $fillable = [
        'state', 'name',
    ];

    protected $fields = [
        //'config'
    ];

    protected $attributes = [
        'id'          => null,
        'state'       => null,
        'name'        => null,
    ];

    protected $casts = [
        'id'          => 'string',
        'state'       => 'integer',
        'name'        => 'string',
    ];

}
