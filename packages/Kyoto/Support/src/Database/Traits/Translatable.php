<?php

namespace Kyoto\Support\Database\Traits;

use Liro\Support\Database\Eloquent\Builder;
use Liro\Support\Database\Scopes\TranslateScope;

trait Translatable
{
    /**
     * Indicates if the model is currently force deleting.
     *
     * @var string
     */
    protected $forceLocale = null;

    /**
     * Indicates if the model is currently force deleting.
     *
     * @var string
     */
    protected $translationsBuffer = null;

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootTranslatable()
    {
        static::saving(function ($model) {

            foreach ( $model->translations as $translation ) {
                $translation->save();
            }

        });

        static::addGlobalScope(new TranslateScope);
    }

    public function getLocale()
    {
        return $this->forceLocale ?: request()->query('locale', app()->getLocale());
    }

    public function getLocaleClass()
    {
        return self::class . 'Locale';
    }

    public function getLocaleInstance($data = [])
    {
        return app()->make($this->getLocaleClass(), [$data]);
    }

    public function getLocalizedColumns()
    {
        return isset($this->localized) ? $this->localized : [];
    }

    public function translations()
    {
        return $this->hasMany($this->getLocaleClass(), 'foreign_id');
    }

    public function isBaseLocale()
    {
        return app('web.language')->getBaseLocale() === $this->getLocale();
    }

    public function getTranslation($locale = null)
    {
        $this->loadMissing('translations');

        if ( empty($locale) ) {
            $locale = $this->getLocale();
        }

        return $this->translations->firstWhere('locale', $locale);
    }

    public function getNewTranslation($locale = null)
    {
        $this->loadMissing('translations');

        if ( empty($locale) ) {
            $locale = $this->getLocale();
        }

        $data = [
            'id' => uuid(), 'foreign_id' => $this->id, 'locale' => $locale
        ];

        $this->translations->add(
            $translation = $this->getLocaleInstance()->fill($data)
        );

        return $translation;
    }

    public function getFirstOrNewTranslation($locale = null)
    {
        $this->loadMissing('translations');

        if ( empty($locale) ) {
            $locale = $this->getLocale();
        }

        $translation = $this->translations->firstWhere('locale', $locale);

        if ( ! $translation ) {
            $translation = $this->getNewTranslation($locale);
        }

        return $translation;
    }

    public function setLocalizedAttribute($key, $value)
    {
        if ( ! $this->exists || $this->isBaseLocale() ) {
            return $this->attributes[$key] = $value;
        }

        $translation = $this->getFirstOrNewTranslation();

        if ( $this->attributes[$key] === $value ) {
            $value = null;
        }

        return $translation->setAttribute($key, $value);
    }

    public function attributesToArray()
    {
        $this->loadMissing('translations');

        $attributes = parent::attributesToArray();

        if ( isset($attributes['_locale']) ) {
            $this->forceLocale = $attributes['_locale'];
        }

        unset($attributes['_locale']);

        if ( ! $this->exists ) {
            return $attributes;
        }

        $translation = $this->getFirstOrNewTranslation();

        foreach ( $this->getLocalizedColumns() as $key ) {
            if ( isset($attributes[$key]) ) {
                $attributes[$key] = data_get($translation, $key) ?: $attributes[$key];
            }
        }

        return $attributes;
    }

    public function fill($attributes)
    {
        if ( isset($attributes['_locale']) ) {
            $this->forceLocale = $attributes['_locale'];
        }

        unset($attributes['_locale']);

        if ( ! $this->exists || $this->isBaseLocale() ) {
            return parent::fill($attributes);
        }

        $translation = $this->getFirstOrNewTranslation();

        foreach ( $this->getLocalizedColumns() as $key ) {

            if ( ! isset($attributes[$key]) ) {
                continue;
            }

            if ( $attributes[$key] === $this->attributes[$key] ) {
                $attributes[$key] = null;
            }

            $translation->setAttribute($key, $attributes[$key]);

            unset($attributes[$key]);
        }

        return parent::fill($attributes);
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ( ! in_array($key, $this->getLocalizedColumns()) ) {
            return $value;
        }

        return data_get($this->getTranslation(), $key) ?: $value;
    }

    public function localize($locale = null)
    {
        if ( empty($locale) ) {
            $locale = $this->getLocale();
        }

        $clone = clone $this->load('translations');

        $clone->forceLocale = $locale;

        return $clone;
    }

}
