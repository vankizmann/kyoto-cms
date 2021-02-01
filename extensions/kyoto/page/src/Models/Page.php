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

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'transaction', 'images'
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

    protected $images = [];

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

            if ( Kyoto::isReady() ) {
                app('kyoto.media')->saveMediaLinks($model->id, $model->images);
            }
        });

        static::deleted(function ($model) {
            if ( Kyoto::isReady() ) {
                app('kyoto.media')->deleteMediaLinks($model->id);
            }
        });

        parent::boot();
    }

    public function fill($attributes)
    {
        if ( isset($attributes['images']) ) {
            $this->setImagesAttribute($attributes['images']);
        }

        return parent::fill($attributes);
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

    public function getImagesAttribute()
    {
        return app('kyoto.media')->fetchMediaLinks($this->id);
    }

    public function setImagesAttribute($value)
    {
        $this->images = $value;
    }

}
