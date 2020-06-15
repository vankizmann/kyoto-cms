<?php

namespace Kyoto\Menu\Models;

use Kyoto\Support\Database\Model;

class MenuLocale extends Model
{
    protected $table = 'menu_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'slug', 'path'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'slug'          => null,
        'path'          => null,
    ];

    protected $casts = [
        'id'            => 'uuid',
        'locale'        => 'string',
        'title'         => 'string',
        'slug'          => 'string',
        'path'          => 'string',
    ];

    public function setSlugAttribute($value, $source)
    {
        $parentPath = null;

        if ( $source->parent ) {
            $parentPath = $source->parent->path;
        }

        $this->attributes['path'] = str_join('/', $parentPath,
            $this->attributes['slug'] = trim($value, '/'));
    }

}
