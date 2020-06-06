<?php

namespace Kyoto\Support\Database\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class StateScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getStateColumn(), '!=', -1);

        return $builder;
    }

}
