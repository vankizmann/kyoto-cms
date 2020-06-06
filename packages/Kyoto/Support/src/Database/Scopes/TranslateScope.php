<?php

namespace Kyoto\Support\Database\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TranslateScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        return $builder;
    }

}
