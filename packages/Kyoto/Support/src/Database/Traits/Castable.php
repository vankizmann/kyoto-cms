<?php

namespace Kyoto\Support\Database\Traits;

trait Castable
{

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

        if ( $this->getCastType($key) === 'uuid' && is_null($value) ) {
            return uuid();
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

        if ( $this->getCastType($key) === 'uuid' && is_null($value) ) {
            return uuid();
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
