<?php

namespace Kyoto\User\Models;

use Kyoto\Support\Database\Model;

class Policy extends Model
{
    protected $table = 'policies';

    protected $guarded = [
        'id',
    ];

    protected $attributes = [
        'id'     => null,
        'title'  => null,
        'type'   => null,
        'action' => null,
    ];

    protected $casts = [
        'id'     => 'string',
        'title'  => 'string',
        'type'   => 'string',
        'action' => 'string',
    ];

}
