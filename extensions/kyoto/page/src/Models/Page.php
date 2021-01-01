<?php

namespace Kyoto\Page\Models;

use Illuminate\Support\Str;
use Kyoto\Menu\Models\Menu;
use Kyoto\Menu\Facades\KyotoConnector;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\Support\Database\Traits\Hide;
use Kyoto\Support\Database\Traits\State;
use Kyoto\Support\Database\Traits\Translatable;

class Page extends \Kyoto\Support\Database\Model
{
    use Translatable, State, Hide;

    protected $table = 'pages';

    protected $fillable = [
        'state', 'hide', 'title', 'slug', 'content', 'builder', 'guard_id'
    ];

    protected $appends = [
        'transaction'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'slug', 'content', 'builder'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'hide'          => null,
        'title'         => null,
        'slug'          => null,
        'content'       => null,
        'builder'       => null
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'hide'          => 'integer',
        'title'         => 'string',
        'slug'          => 'string',
        'content'       => 'string',
        'builder'       => 'array'
    ];

    protected $with = [
        'menus'
    ];

    protected static function boot()
    {
        static::saving(function ($model) {
            if ( $model->isBaseLocale() && empty($model->slug) ) {
                $model->setSlugAttribute($model->title);
            }
        });

        static::saved(function ($model) {
            Kyoto::localized(null, function () use ($model) {
                KyotoConnector::find('kyoto/page::page')->syncronize($model);
            });
        });

        parent::boot();
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'foreign_id', 'id')
            ->where('type', $this->transaction);
    }

    public function getTransactionAttribute()
    {
        return 'kyoto/page::page';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::snake(
            str_replace(['.', ','], '', $value), '-');
    }

}
