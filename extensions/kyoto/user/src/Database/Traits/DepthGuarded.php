<?php

namespace Kyoto\User\Database\Traits;

use Illuminate\Database\Eloquent\Builder;
use Kyoto\Application\Facades\Kyoto;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\User\Database\Scopes\GuardScope;

/**
 * Trait PolicyTrait
 */
trait DepthGuarded
{
    /**
     * @var bool $useGuard
     */
    protected $useDepthGuard;

    public static function bootDepthGuarded()
    {
        if ( ! Kyoto::isReady() ) {
            return;
        }

        static::addGlobalScope(new GuardScope);
    }

    public function getUseDepthGuard()
    {
        if ( ! isset($this->useDepthGuard) ) {
            return KyotoUser::isGuarded();
        }

        return $this->useDepthGuard;
    }

    public function getDepthGuardColumn()
    {
        return 'guard_id';
    }

    public function disableDepthGuard()
    {
        $this->useDepthGuard = false;
        return $this;
    }

    public function enableDepthGuard()
    {
        $this->useDepthGuard = true;
        return $this;
    }

    public function scopeWithoutDepthGuard(Builder $builder)
    {
        $model = $builder->getModel()->disableDepthGuard();
        return $builder->setModel($model);
    }

    public function scopeWithDepthGuard(Builder $builder)
    {
        $model = $builder->getModel()->enableDepthGuard();
        return $builder->setModel($model);
    }

}
