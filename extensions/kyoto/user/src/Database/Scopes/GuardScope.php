<?php

namespace Kyoto\User\Database\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GuardScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $modelClass = get_class($model);

        if ( $model->getUseDepthGuard() ) {

            $guardDepth = app('kyoto.user')
                ->getPolicyDepth($modelClass);

            $userId = app('kyoto.user')
                ->getUser('id', null);

            $builder->where(function ($query) use ($model, $guardDepth, $userId) {

                if ( method_exists($model, 'skipGuardedBuilder') ) {
                    $query = $model->skipGuardedBuilder($query);
                }

                $query
                    ->orWhere($model->getDepthGuardColumn(), '>=', $guardDepth)
                    ->orWhere($model->getDepthGuardColumn(), '=', 0);
            });
        }

        return $builder;
    }

}
