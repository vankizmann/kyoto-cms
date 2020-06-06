<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;

class Menu extends \Kyoto\Support\Database\Model
{
    use Node;

    protected $table = 'menus';

    protected $fillable = [
        'state', 'hide', 'type', 'layout', 'title', 'slug', 'route', 'path', 'guard', 'option'
    ];

    protected $fields = [
        //'config'
    ];

    protected $appends = [
        //'connector', 'final_layout', 'icon_url', 'options'
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
        'layout'        => null,
        'title'         => null,
        'slug'          => null,
        'route'         => null,
        'path'          => null,
        'option'        => null,
        'guard'         => null
    ];

    protected $casts = [
        'id'            => 'uuid',
        'state'         => 'integer',
        'hide'          => 'integer',
        'type'          => 'string',
        'layout'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
        'option'        => 'array',
        'guard'         => 'integer'
    ];

    protected static function boot()
    {
        self::saved(function () {
            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->update();
            }
        });

        parent::boot();
    }

    public function setSlugAttribute($value)
    {
        $parentPath = null;

        if ( $this->parent ) {
            $parentPath = rtrim($this->parent->path, '/');
        }

        $this->attributes['path'] = str_join('/', $parentPath,
            $this->attributes['slug'] = trim($value, '/'));
    }

}
