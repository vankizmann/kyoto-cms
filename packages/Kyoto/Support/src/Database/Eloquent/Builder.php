<?php

namespace Kyoto\Support\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder as BuilderPrototype;

class Builder extends BuilderPrototype
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
        if ( $column instanceof \Closure ) {
            return parent::where(...func_get_args());
        }

        $localized = $this->model->getLocalizedColumns();

        if ( ! in_array($column, $localized) ) {
            return parent::where(...func_get_args());
        }

        $arguments = func_get_args();

        return parent::where(...func_get_args())
            ->orWhereHas('translations', function($query) use ($arguments) {
                $query->where(...$arguments);
            });
    }

}
