<?php

namespace Kyoto\User\Database\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
                1, app('kyoto.user')->getGateDepth()
            ]);
        });

        return $builder;
    }

}
