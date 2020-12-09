<?php

namespace Kyoto\Support\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Builder extends EloquentBuilder
{
    /**
     * Add a basic where clause to the query.
     *
     * @param mixed $column
     * @param mixed $operator
     * @param mixed $value
     * @param string $boolean
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $args = func_get_args();

        if ( $column instanceof \Closure ) {
            return parent::where(...$args);
        }

        $localized = $this->getModel()
            ->getLocalizedColumns();

        foreach ( $localized as $prop ) {
            $localized[] = $this->getModel()->getTable() . '.' . $prop;
        }

        if ( ! in_array($column, $localized) ) {
            return parent::where(...$args);
        }

        $transWhere = function($query) use ($args) {
            $query->where($args[0], $args[1], $args[2], 'and');
        };

        return parent::where(...$args)
            ->orWhereHas('translations', $transWhere);
    }

}
