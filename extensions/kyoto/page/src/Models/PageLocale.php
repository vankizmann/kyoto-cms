<?php

namespace Kyoto\Page\Models;

use Illuminate\Support\Str;
use Kyoto\Support\Database\Model;

class PageLocale extends Model
{
    protected $table = 'page_locales';

    protected $fillable = [
        'id', 'foreign_id', 'locale', 'title', 'slug', 'content'
    ];

    protected $attributes = [
        'id'            => null,
        'locale'        => null,
        'title'         => null,
        'content'       => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'locale'        => 'string',
        'title'         => 'string',
        'content'       => 'string',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::snake($value, '-');
    }

}
