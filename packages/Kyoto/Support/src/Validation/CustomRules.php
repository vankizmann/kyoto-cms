<?php

namespace Kyoto\Support\Validation;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomRules
{
    /**
     * Validates value against given table excepts id
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function unique_val($attribute, $value, $parameters)
    {
        if ( ! isset($parameters[0]) ) {
            throw new ValidationException('Validation rule uval requires at least 1 parameters.');
        }

        $query = DB::table($parameters[0])
            ->where($attribute, '=', $value);

        if ( ! isset($parameters[1]) ) {
            $parameters[1] = 'id';
        }

        if ( $id = request()->query('id') ) {
            $query->where($parameters[1], '!=' ,$id);
        }

        return ! $query->count();
    }

    /**
     * Validates value only if is new
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function required_new($attribute, $value, $parameters)
    {
        return !! request()->query('id') ? true : ! empty($value);
    }

}
