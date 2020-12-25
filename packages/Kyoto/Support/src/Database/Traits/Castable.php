<?php

namespace Kyoto\Support\Database\Traits;

use Illuminate\Database\Eloquent\Model;

trait Castable
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootCastable()
    {
        static::creating(function (Model $model) {

            foreach ( array_keys($model->getCasts()) as $key ) {
                if ( ! isset($model->attributes[$key]) ) {
                    $model->setAttribute($key, $model->{$key});
                }
            }

        });
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts()
    {
        return $this->casts;
    }

    /**
     * Get the type of cast for a model attribute.
     *
     * @param  string  $key
     * @return string
     */
    protected function getCastType($key)
    {
        if ( isset($this->casts[$key]) ) {
            return trim(strtolower($this->casts[$key]));
        }

        return parent::getCastType($key);
    }

    protected function setCastAttribute($key, $value)
    {
        if ( $this->getCastType($key) === 'object' && is_object($value) ) {
            return json_encode($value, true);
        }

        if ( $this->getCastType($key) === 'object' && is_array($value) ) {
            return json_encode($value, true);
        }

        if ( $this->getCastType($key) === 'array' && is_object($value) ) {
            return json_encode($value, true);
        }

        if ( $this->getCastType($key) === 'array' && is_array($value) ) {
            return json_encode($value, true);
        }

        if ( $this->getCastType($key) === 'params' && is_object($value) ) {
            return http_build_query($value);
        }

        if ( $this->getCastType($key) === 'params' && is_array($value) ) {
            return http_build_query($value);
        }

        return $value;
    }
    /**
     * Cast an attribute to a native PHP type.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if ( $this->getCastType($key) === 'object' && is_null($value) ) {
            return new \StdClass();
        }

        if ( $this->getCastType($key) === 'object' && is_string($value) ) {
            return json_decode($value, false);
        }

        if ( $this->getCastType($key) === 'array' && is_null($value) ) {
            return [];
        }

        if ( $this->getCastType($key) === 'array' && is_string($value) ) {
            return json_decode($value, true);
        }

        if ( $this->getCastType($key) === 'params' && is_null($value) ) {
            return [];
        }

        if ( $this->getCastType($key) === 'params' && is_string($value) ) {
            parse_str($value, $result); return $result;
        }

        if ( $this->getCastType($key) === 'string' && is_null($value) ) {
            return '';
        }

        if ( $this->getCastType($key) === 'integer' && is_null($value) ) {
            return 0;
        }

        return parent::castAttribute($key, $value);
    }

}
