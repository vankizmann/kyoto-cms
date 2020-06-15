<?php

namespace Kyoto\User\Database\Traits;

use Illuminate\Database\Eloquent\Builder;
use Kyoto\User\Database\Scopes\GuardScope;

/**
 * Trait PolicyTrait
 */
trait DepthGuarded
{
    /**
     * @var bool $useGuard
     */
    protected $useDepthGuard = false;

    /**
     * @var string $guardColumn
     */
    protected $depthGuardColumn = 'guard';

    public static function bootDepthGuarded()
    {
        static::addGlobalScope(new GuardScope);
    }

    public function getUseDepthGuard()
    {
        return $this->useDepthGuard;
    }

    public function getDepthGuardColumn()
    {
        return $this->depthGuardColumn;
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
