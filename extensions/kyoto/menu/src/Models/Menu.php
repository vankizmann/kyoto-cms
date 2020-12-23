<?php

namespace Kyoto\Menu\Models;

use Baum\NestedSet\Node;
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
        //'parent_id', 'left', 'right'
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
        return url($this->path);
    }

    public function getConnectorAttribute()
    {
        $connector = Connector::find($this->type);

        if ( empty($connector) ) {
            return [];
        }

        return $connector->options($this);
    }

    public function toArray()
    {
        $attributes = [];

        foreach ( array_keys($this->attributes) as $key ) {
            $attributes[$key] = $this->attributes[$key] ;
        }

        foreach ( $this->appends as $key ) {
            $attributes[$key] = $this->getAttribute($key);
        }

        $attributes['option'] = $this->getAttribute('option');

        if ( isset($this->relations['children']) ) {
            $attributes['children'] = $this->getRelation('children');
        }

        return $attributes;
    }

}
