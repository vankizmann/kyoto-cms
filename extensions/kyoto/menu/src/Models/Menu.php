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
        'foreign_id', 'state', 'hide', 'type', 'layout', 'title', 'slug', 'route', 'path', 'guard', 'option'
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
        'foreign_id'    => null,
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
        'foreign_id'    => 'string',
        'state'         => 'integer',
        'hide'          => 'integer',
        'type'          => 'string',
        'layout'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
        'option'        => 'object',
        'guard'         => 'integer'
    ];

    protected static function boot()
    {
        static::saving(function ($model) {

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->clear();
            }

            $model->fill([
                'route' => '/', 'path' => $model->slug
            ]);
        });

        static::saved(function ($model) {

            if ( ($parentNode = $model->parent) && $model->isBaseLocale() ) {

                $model->attributes['route'] = $model->slug ?: '/';

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

            if ( $model->attributes['slug'] !== $model->original['slug'] ) {
                //dd($model);
            }

        });

        parent::boot();
    }

    public function getUnguardedRoot()
    {
        return app('kyoto.user')->unguarded(function () {
            return $this->getRoot();
        });
    }

    public function getLogin($key = null, $fallback = null)
    {
        $login = app('kyoto.user')->unguarded(function () {
            return $this->getRoot()->getDescendantsAndSelf()
                ->where('type', 'kyoto/user::login')->first();
        });

        if ( $login && $key ) {
            return data_get($login, $key, $fallback);
        }

        return $login;
    }

    public function getLogout($key = null, $fallback = null)
    {
        $logout = app('kyoto.user')->unguarded(function () {
            return $this->getRoot()->getDescendantsAndSelf()
                ->where('type', 'kyoto/user::logout')->first();
        });

        if ( $logout && $key ) {
            return data_get($logout, $key, $fallback);
        }

        return $logout;
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
        if ( empty($this->parent_id) ) {
            $this->attributes['path'] = trim($value, '/');
        }

        $this->attributes['slug'] = trim($value, '/');;
    }

}
