<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
use Illuminate\Support\Str;
use Kyoto\Menu\Facades\Connector;
use Kyoto\Menu\Models\Traits\Pathable;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;
use Kyoto\User\Database\Traits\DepthGuarded;
use Kyoto\Support\Database\Traits\Translatable;

class Menu extends \Kyoto\Support\Database\Model
{
    use Node, State, Hide, Translatable, DepthGuarded, Pathable;

    protected $table = 'menus';

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'preview', 'transaction', 'connector'
    ];

    protected $fields = [
        //'config'
    ];

    protected $hidden = [
        'parent_id', 'left', 'right'
    ];

    protected $localized = [
        'title', 'slug', 'route', 'path'
    ];

    protected $attributes = [
        'id'            => null,
        'foreign_id'    => null,
        'state'         => null,
        'hide'          => null,
        'system'        => null,
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
        'system'        => 'integer',
        'type'          => 'string',
        'layout'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
        'option'        => 'object',
        'guard'         => 'integer'
    ];

    protected $relationships = [
        'parent', 'children'
    ];

    protected static function boot()
    {
        static::saving(function ($model) {

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->clear();
            }

        });

        static::moving(function ($model) {

            if ( app('kyoto')->isReady() ) {
                app('kyoto.menu')->clear();
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

    public function getTransactionAttribute()
    {
        return null;
    }

    public function getOption($key, $fallback = null)
    {
        return data_get($this->__get('option'), $key, $fallback);
    }

    public function setOption($key, $value)
    {
        $option = $this->__get('option');

        data_set($option, $key, $value);

        $option = $this->__set('option', $option);

        return $this;
    }

    public function setOptions($values)
    {
        $option = $this->__get('option');

        foreach ( $values as $key => $value ) {
            data_set($option, $key, $value);
        }

        $option = $this->__set('option', $option);

        return $this;
    }

    public function getPreviewAttribute()
    {
        return url($this->attributes['path']);
    }

    public function getConnectorAttribute()
    {
        if ( ! Connector::has($this->attributes['type']) ) {
            return [];
        }

        return Connector::find($this->attributes['type'])
            ->options($this);
    }

    public function toArray()
    {
        $attributes = $this->attributesToArray(false);

        foreach ( $this->appends as $key ) {
            if ( $this->hasGetMutator($key) ) {
                $attributes[$key] = $this->{'get' . Str::studly($key) . 'Attribute'}($key);
            }
        }

        $attributes['option'] = $this->castAttribute('option',
            $attributes['option']);

        foreach ( array_keys($this->relations) as $key ) {
            $attributes[$key] = $this->getRelation($key)->toArray();
        }

        return $attributes;
    }

}
