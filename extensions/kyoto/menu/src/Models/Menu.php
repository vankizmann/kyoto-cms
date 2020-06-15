<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
use Kyoto\Routing\Route\RouteHelper;
use Kyoto\Support\Database\Traits\Translatable;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;

class Menu extends \Kyoto\Support\Database\Model
{
    use Node, State, Hide, Translatable;

    protected $table = 'menus';

    protected $fillable = [
        'state', 'hide', 'type', 'layout', 'title', 'slug', 'path', 'guard', 'option'
    ];

    protected $fields = [
        //'config'
    ];

    protected $appends = [
        'route', //'connector', 'final_layout', 'icon_url', 'options'
    ];

    protected $hidden = [
        'lft', 'rgt', 'parent_id'
    ];

    protected $localized = [
        'title', 'slug', 'path'
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
        'path'          => 'string',
        'option'        => 'array',
        'guard'         => 'integer'
    ];

    protected static function boot()
    {
        static::saved(function () {
            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->update();
            }
        });

        parent::boot();
    }

    public function getParentAttribute()
    {
        $parentNode = $this->parent()->first();

        if ( $parentNode ) {
            return $parentNode->localized($this->forceLocale);
        }

        return $parentNode;
    }

    public function setSlugAttribute($value)
    {
        $parentPath = null;

        if ( $this->parent ) {
            $parentPath = $this->parent->path;
        }

        $this->attributes['path'] = str_join('/', $parentPath,
            $this->attributes['slug'] = trim($value, '/'));
    }

    public function getRouteAttribute()
    {
        return RouteHelper::getRoute($this->path);
    }

    public function getLayoutAttribute()
    {
        if ( ! $this->attributes['layout'] && $this->parent ) {
            return $this->parent->layout;
        }

        return $this->attributes['layout'];
    }

}
