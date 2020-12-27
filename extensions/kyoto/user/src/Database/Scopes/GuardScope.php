<?php

namespace Kyoto\User\Database\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Kyoto\User\Facades\KyotoUser;

class GuardScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if ( ! $model->getUseDepthGuard() ) {
            return $builder;
        }

        $builder->where(function ($query) use ($model) {

            if ( method_exists($model, 'skipGuardedBuilder') ) {
                $query = $model->skipGuardedBuilder($query);
            }

            $query->whereNotBetween($model->getDepthGuardColumn(), [
                1, KyotoUser::getGateDepth()
            ]);
        });

        return $builder;
    }

}
