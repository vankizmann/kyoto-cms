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
        'transaction', 'images', 'widgets'
    ];

    protected $fields = [
        //'config'
    ];

    protected $localized = [
        'title', 'slug', 'content'
    ];

    protected $attributes = [
        'id'            => null,
        'state'         => null,
        'hide'          => null,
        'title'         => null,
        'slug'          => null,
        'content'       => null,
    ];

    protected $casts = [
        'id'            => 'string',
        'state'         => 'integer',
        'hide'          => 'integer',
        'title'         => 'string',
        'slug'          => 'string',
        'content'       => 'string',
    ];

    protected $with = [
        'menus'
    ];

    protected $images = [];

    protected $widgets = [];

    protected static function boot()
    {
        static::saving(function ($model) {

            if ( $model->isBaseLocale() && empty($model->slug) ) {
                $model->setSlugAttribute($model->title);
            }

        });

        static::saved(function ($model) {

            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->saveWidgets($model->id, $model->widgets);
            }

            if ( Kyoto::isReady() ) {
                app('kyoto.media')->saveMediaLinks($model->id, $model->images);
            }

            Kyoto::localized(null, function () use ($model) {
                KyotoConnector::find('kyoto/page::page')->sync($model);
            });

        });

        static::deleted(function ($model) {

            if ( Kyoto::isReady() ) {
                app('kyoto.widget')->deleteWidgets($model->id);
            }

            if ( Kyoto::isReady() ) {
                app('kyoto.media')->deleteMediaLinks($model->id);
            }

            Kyoto::localized(null, function () use ($model) {
                KyotoConnector::find('kyoto/page::page')->unsync($model);
            });

        });

        parent::boot();
    }

    public function fill($attributes)
    {
        if ( isset($attributes['images']) ) {
            $this->setImagesAttribute($attributes['images']);
        }

        if ( isset($attributes['widgets']) ) {
            $this->setWidgetsAttribute($attributes['widgets']);
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

    public function getWidgetsAttribute()
    {
        return app('kyoto.widget')->fetchWidgets($this->id);
    }

    public function setWidgetsAttribute($value)
    {
        $this->widgets = $value;
    }

}
