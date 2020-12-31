<?php

namespace Kyoto\Media\Models;

use Baum\NestedSet\Node;
use Kyoto\User\Database\Traits\DepthGuarded;
use Kyoto\Support\Database\Traits\Translatable;

class Media extends \Kyoto\Support\Database\Model
{
    use Node, Translatable, DepthGuarded;

    protected $table = 'medias';

    protected $fillable = [
        'title', 'description', 'copyright', 'file', 'type', 'guard_id'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'description', 'copyright'
    ];

    protected $attributes = [
        'id'            => null,
        'title'         => null,
        'description'   => null,
        'copyright'     => null,
        'file'          => null,
        'type'          => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'title'         => 'string',
        'description'   => 'string',
        'copyright'     => 'string',
        'file'          => 'string',
        'type'          => 'string',
    ];

}
