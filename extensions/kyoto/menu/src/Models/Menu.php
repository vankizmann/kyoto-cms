<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
use Illuminate\Support\Facades\DB;
//use Kalnoy\Nestedset\NodeTrait as Node;
use Kyoto\Support\Database\Traits\Translatable;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;
use Kyoto\User\Database\Traits\DepthGuarded;

class Menu extends \Kyoto\Support\Database\Model
{
    use Node, State, Hide, Translatable, DepthGuarded;

    protected $table = 'menus';

    protected $fillable = [
        'state', 'hide', 'type', 'layout', 'title', 'slug', 'route', 'path', 'guard', 'option'
    ];

    protected $fields = [
        //'config'
    ];

    protected $hidden = [
        'parent_id', '_lft', '_rgt'
    ];

    protected $localized = [
        'title', 'slug', 'route', 'path'
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
        'id'            => 'string',
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
        static::saved(function ($model) {

            if ( $model->parent_id ) {

                $path = DB::table('menus')->where('id', $model->parent_id)
                    ->pluck('path')->first();

                $route = DB::table('menus')->where('id', $model->parent_id)
                    ->whereNotNull('parent_id')->pluck('slug')->first();

                $data = [
                    'path' => str_join('/', $path, $model->slug),
                    'route' => str_join('/', $route, $model->slug)
                ];

                DB::table('menus')->where('id', $model->id)
                    ->update($data);
            }


            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->update();
            }

        });

        parent::boot();
    }

    public function getRoot2($key = null, $fallback = null)
    {
        $root = $this->newQuery()->whereNull('parent_id')
            ->where('_lft', '<=', $this->_lft)->orderBy('_lft', 'desc')->first();

        if ( ! empty($key) ) {
            return data_get($root, $key, $fallback);
        }

        return $root;
    }

    public function getLogin()
    {
        return $this->getRoot()->getDescendants()
            ->where('type', 'kyoto/user::login')->first();
    }

    public function getParentAttribute()
    {
        $parentNode = $this->parent()->first();

        if ( $parentNode ) {
            return $parentNode->localized($this->forceLocale);
        }

        return $parentNode;
    }

    public function getRouteAttribute()
    {
        return "/{$this->attributes['route']}";
    }

    public function setSlugAttribute($value)
    {
        if ( empty($this->parent_id) ) {
            $this->attributes['path'] = trim($value, '/');
        }

        $this->attributes['slug'] = trim($value, '/');;
    }

    public function toArray()
    {
        // List out all attributes you want to get, anytime this model is called.
        $attributes = [];
        $attributes['id'] = $this->attributes['id'];
        $attributes['state'] = $this->attributes['state'];
        $attributes['hide'] = $this->attributes['hide'];
        $attributes['title'] = $this->attributes['title'];
        $attributes['path'] = $this->attributes['path'];
        $attributes['slug'] = $this->attributes['slug'];
        $attributes['route'] = '/'.$this->attributes['route'];
        $attributes['type'] = $this->attributes['type'];
        $attributes['option'] = json_decode($this->attributes['option'] ?: '{}');
        $attributes['children'] = $this->relations['children']->toArray();

        return $attributes;
    }

}
