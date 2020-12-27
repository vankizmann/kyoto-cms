<?php

namespace Kyoto\Support\Database;

use Illuminate\Support\Collection;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use Traits\Castable, Traits\Paginatable, Traits\Datatable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Relationship keys which are fillable.
     *
     * @var array
     */
    protected $relationships = [];

    protected static function boot()
    {
        self::creating(function ($model) {
            if ( empty($model->attributes['id']) ) {
                $model->forceSetAttribute('id', uuid());
            }
        });

        self::saving(function ($model) {
            if ( empty($model->attributes['id']) ) {
                $model->forceSetAttribute('id', uuid());
            }
        });

        parent::boot();
    }

    public function forceSetAttribute($key, $value) {

        static::unguarded(function () use ($key, $value) {
            $this->setAttribute($key, $value);
        });

        return $this;
    }

    public function maybeSetAttribute($key, $value) {

        if ( in_array($key, $this->getAttributeKeys()) ) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    public function cloneAttributes($source, $keys = [])
    {
        foreach ( array_intersect($keys, $source->getAttributeKeys()) as $key ) {
            $this->maybeSetAttribute($key, $source->getAttribute($key));
        }

        return $this;
    }

    public function getAttributeKeys()
    {
        return array_keys($this->getAttributes());
    }

    public function fill($attributes)
    {
        if ( empty($this->attributes['id']) && ! empty($attributes['id']) ) {
            $this->forceSetAttribute('id', $attributes['id']);
        }

        foreach ( $attributes as $key => $value ) {

            if ( ! in_array($key, $this->relationships) ) {
                continue;
            }

            if ( is_a($value, self::class) ) {
                $this->load($key)->{$key}()->associate($value);
            }

            if ( is_a($value, Collection::class) ) {
                $this->load($key)->{$key}()->sync($value);
            }

            unset($attributes[$key]);
        }

        return parent::fill($attributes);
    }

}
