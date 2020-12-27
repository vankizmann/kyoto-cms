<?php

namespace Kyoto\User\Database\Traits;

use Illuminate\Database\Eloquent\Builder;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\User\Database\Observers\GuardObserver;

/**
 * Trait ActionGuardTrait
 */
trait ActionGuarded
{
    /**
     * @var bool $useGuard
     */
    protected $useActionGuard;

    public static function bootActionGuarded()
    {
        if ( ! Kyoto::isReady() ) {
            return;
        }

        static::observe(new GuardObserver);
    }

    public function getUseActionGuard()
    {
        if ( ! isset($this->useActionGuard) ) {
            return KyotoUser::isGuarded();
        }

        return $this->useActionGuard;
    }

    public function disableActionGuard()
    {
        $this->useActionGuard = false;
        return $this;
    }

    public function enableActionGuard()
    {
        $this->useActionGuard = true;
        return $this;
    }

    public function scopeWithoutActionGuard(Builder $builder)
    {
        $model = $builder->getModel()->disableActionGuard();
        return $builder->setModel($model);
    }

    public function scopeWithActionGuard(Builder $builder)
    {
        $model = $builder->getModel()->enableActionGuard();
        return $builder->setModel($model);
    }

}
