<?php

namespace Kyoto\User\Database\Observers;

use Illuminate\Database\Eloquent\Model;
use Kyoto\User\Exceptions\PolicyException;

class GuardObserver
{

    public function creating(Model $model)
    {
        $modelClass = get_class($model);

        if ( $model->getUseActionGuard() && ! app('kyoto.user')->hasPolicyAction($modelClass, 'create') ) {
            throw new PolicyException('Access to ' . $modelClass . '@create not granted.', 403);
        }

        return;
    }

    public function updating(Model $model)
    {
        $modelClass = get_class($model);

        if ( $model->getUseActionGuard() && ! app('kyoto.user')->hasPolicyAction($modelClass, 'update') ) {
            throw new PolicyException('Access to ' . $modelClass . '@update not granted.', 403);
        }

        return;
    }

    public function deleting(Model $model)
    {
        $modelClass = get_class($model);

        if ( $model->getUseActionGuard() && ! app('kyoto.user')->hasPolicyAction($modelClass, 'delete') ) {
            throw new PolicyException('Access to ' . $modelClass . '@delete not granted.', 403);
        }

        return;
    }

}
