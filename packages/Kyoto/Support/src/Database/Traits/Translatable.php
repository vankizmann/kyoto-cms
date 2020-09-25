<?php

namespace Kyoto\Support\Database\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kyoto\Support\Database\Eloquent\Builder;
use Kyoto\Support\Database\Scopes\TranslateScope;

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

            $model->translationsBuffer = $model->translations;

        });

        static::saved(function ($model) {

            foreach ( $model->translationsBuffer as $translation ) {
                if ( is_a($translation, Model::class) ) {
                    $translation->save();
                }
            }

        });

        static::addGlobalScope(new TranslateScope);
    }

    public function initializeTranslatable()
    {
        $this->with[] = 'translations';
    }

    public function translations()
    {
        return $this->hasMany($this->getLocaleClass(), 'foreign_id');
    }

    public function getLocale()
    {
        if ( ! $this->exists && ! $this->forceLocale ) {
            $this->forceLocale = app('kyoto')->getFallbackLocale();
        }

        return $this->forceLocale ?: app('kyoto')->getLocale();
    }

    public function setLocale($locale)
    {
        $this->forceLocale = $locale;

        return $this;
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

    public function isBaseLocale()
    {
        return app('kyoto')->getFallbackLocale() === $this->getLocale();
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

        if ( empty($translation->locale) ) {
            $translation->locale = $locale;
        }

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

    public function setLocalizedAttribute($key, $value, $translation = null)
    {
        if ( ! $this->exists || $this->isBaseLocale() ) {
            return $this->attributes[$key] = $value;
        }

        if ( ! $translation ) {
            $translation = $this->getFirstOrNewTranslation();
        }

        if ( $this->attributes[$key] === $value ) {
            $value = null;
        }

        if ( $translation->hasSetMutator($key) ) {
            return $translation->{'set' . Str::studly($key) . 'Attribute'}($value, $this);
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

        if ( $this->isBaseLocale() || ! $this->exists ) {
            return $attributes;
        }

        $translation = $this->getTranslation();

        if ( ! $translation ) {
            return $attributes;
        }

        foreach ( $this->getLocalizedColumns() as $key ) {
            $attributes[$key] = $this->getAttribute($key, $translation);
        }

        return $attributes;
    }

    public function fill($attributes)
    {
        if ( isset($attributes['_locale']) ) {
            $this->forceLocale = $attributes['_locale'];
        }

        unset($attributes['_locale'], $attributes['translations']);

        if ( ! $this->exists || $this->isBaseLocale() ) {
            return parent::fill($attributes);
        }

        $translation = $this->getFirstOrNewTranslation();

        foreach ( $this->getLocalizedColumns() as $key ) {

            if ( ! isset($attributes[$key]) ) {
                continue;
            }

            $this->setLocalizedAttribute($key, $attributes[$key], $translation);

            unset($attributes[$key]);
        }

        return parent::fill($attributes);
    }

    public function getAttribute($key, $translation = null)
    {
        $value = parent::getAttribute($key);

        if ( $this->isBaseLocale() || ! in_array($key, $this->getLocalizedColumns()) ) {
            return $value;
        }

        if ( ! $translation ) {
            $translation = $this->getTranslation();
        }

        if ( ! $translation || ! $translation->exists ) {
            return $value;
        }

        if ( $translation->hasGetMutator($key) ) {
            return $translation->{'get' . Str::studly($key) . 'Attribute'}($this);
        }

        return empty($localized = $translation->getAttribute($key)) ? $value : $localized;
    }

    public function localized($locale = null)
    {
        if ( empty($locale) ) {
            $locale = $this->getLocale();
        }

        $clone = clone $this;

        $clone->setLocale($locale);

        return $clone;
    }

}
