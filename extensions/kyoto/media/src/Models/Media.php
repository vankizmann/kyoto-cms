<?php

namespace Kyoto\Media\Models;

use Kyoto\Support\Database\Traits\Translatable;
use Kyoto\User\Database\Traits\DepthGuarded;

class Media extends \Kyoto\Support\Database\Model
{
    use Translatable, DepthGuarded;

    protected $table = 'medias';

    protected $fillable = [
        'title', 'description', 'source', 'file', 'type', 'guard_id'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'desciption'
    ];

    protected $attributes = [
        'id'            => null,
        'title'         => null,
        'desciption'    => null,
        'source'        => null,
        'file'          => null,
        'type'          => null
    ];

    protected $casts = [
        'id'            => 'string',
        'title'         => 'string',
        'desciption'    => 'string',
        'source'        => 'string',
        'type'          => 'string',
        'file'          => 'string'
    ];

}
