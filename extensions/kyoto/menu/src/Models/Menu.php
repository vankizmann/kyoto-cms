<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
use Illuminate\Support\Facades\DB;
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

            if ( ($parentNode = $model->parent) && $model->isBaseLocale() ) {

                $model->attributes['route'] = $model->slug;

                if ( ! empty($parentNode->parent_id) ) {
                    $model->attributes['route'] = str_join('/', $parentNode->route, $model->slug);
                }

                if ( $model->attributes['route'] ) {
                    $model->attributes['route'] = '/' . trim($model->attributes['route'], '/');
                }

                $model->attributes['path'] = str_join('/', $parentNode->path, $model->slug);

                $data = [
                    'path' => $model->attributes['path'], 'route' => $model->attributes['route']
                ];

                DB::table('menus')->where('id', $model->id)->update($data);
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

    public function getRouteAttribute2()
    {
        return '/' . trim($this->attributes['route'], '/');
    }

    public function setSlugAttribute($value)
    {
        if ( empty($this->parent_id) ) {
            $this->attributes['path'] = trim($value, '/');
        }

        $this->attributes['slug'] = trim($value, '/');;
    }

    public function toArray2()
    {
        $attributes = [
            'id', 'state', 'hide', 'layout', 'type', 'title', 'path', 'slug', 'updated_at', 'created_at',
        ];

        $data = [
            'option' => json_decode($this->attributes['option'] ?: '{}')
        ];

        foreach ( $attributes as $attribute ) {
            $data[$attribute] = $this->attributes[$attribute];
        }

        if ( isset($this->attributes['route']) ) {
            $data['route'] = $this->getRouteAttribute();
        }

        if ( ! isset($this->attributes['locale']) ) {
            $data['_locale'] = $this->getLocale();
        }

        if ( isset($this->relations['children']) ) {
            $data['children'] = $this->relations['children']->toArray();
        }

        return $data;
    }

}
