<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Node;

    protected $table = 'menus';

    protected $fillable = [
        'state', 'hide', 'type', 'icon', 'layout', 'title', 'slug', 'route', 'path', 'guard', 'extend'
    ];

    protected $fields = [
        'config'
    ];

    protected $appends = [
        'connector', 'final_layout', 'icon_url', 'options'
    ];

    protected $hidden = [
        'lft', 'rgt', 'parent_id'
    ];

    protected $localized = [
        'layout', 'title', 'slug', 'route', 'path'
    ];

    protected $relationships = [
        'parent', 'childs'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'hide'          => null,
        'type'          => null,
        'icon'          => null,
        'layout'        => null,
        'title'         => null,
        'slug'          => null,
        'route'         => null,
        'path'          => null,
        'extend'        => null,
        'guard'         => null
    ];

    protected $casts = [
        'id'            => 'uuid',
        'state'         => 'integer',
        'hide'          => 'integer',
        'type'          => 'string',
        'icon'          => 'string',
        'layout'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
        'extend'        => 'array',
        'guard'         => 'integer'
    ];

}
