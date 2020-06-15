<?php

namespace Kyoto\Menu\Models;

use Kyoto\Support\Database\Model;

class MenuLocale extends Model
{
    protected $table = 'menu_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'slug', 'route', 'path'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'slug'          => null,
        'route'         => null,
        'path'          => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'locale'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'route'         => 'string',
        'path'          => 'string',
    ];

    public function setSlugAttribute($value, $source)
    {
        $this->attributes['slug'] = trim($value, '/');

        $parentRoute = null;

        if ( $source->parent ) {
            $this->attributes['route'] = str_join('/', $source->parent->route, $this->attributes['slug']);
        }

        $this->attributes['route'] = $parentRoute;

        $parentPath = null;

        if ( $source->parent ) {
            $parentPath = $source->parent->path;
        }

        $this->attributes['path'] = str_join('/',
            $parentPath, $this->attributes['slug']);
    }

}
