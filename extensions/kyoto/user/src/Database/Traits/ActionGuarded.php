<?php

namespace Kyoto\User\Database\Traits;

use Illuminate\Database\Eloquent\Builder;
use Kyoto\User\Database\Observers\GuardObserver;

/**
 * Trait ActionGuardTrait
 */
trait ActionGuarded
{
    /**
     * @var bool $useGuard
     */
    protected $useActionGuard = true;

    public static function bootActionGuarded()
    {
        static::observe(new GuardObserver);
    }

    public function getUseActionGuard()
    {
        return app('kyoto.user')->isGuarded() && $this->useActionGuard;
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
