<?php

namespace Kyoto\Page\Models;

use Kyoto\Support\Database\Traits\Translatable;
use Kyoto\User\Database\Traits\DepthGuarded;

class Page extends \Kyoto\Support\Database\Model
{
    use Translatable;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'content', 'guard_id'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'content'
    ];

    protected $attributes = [
        'id'            => null,
        'title'         => null,
        'content'       => null
    ];

    protected $casts = [
        'id'            => 'uuid',
        'title'         => 'string',
        'content'       => 'string'
    ];

}
