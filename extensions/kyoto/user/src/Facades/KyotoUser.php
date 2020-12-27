<?php

namespace Kyoto\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static boolean isGuarded()
 * @method static boolean isNotGuarded()
 * @method static \Kyoto\User\UserManager enableGuard()
 * @method static \Kyoto\User\UserManager disableGuard()
 * @method static mixed unguarded($callback)
 * @method static mixed guarded($callback)
 * @method static mixed getUser($key = null, $fallback = null)
 * @method static void setUser(\Kyoto\User\Model\User $user)
 * @method static integer getGateDepth($fallback = 100000)
 * @method static boolean hasPolicyAction($action, $type = 'extension', $fallback = false)
 **/
class KyotoUser extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto.user';
    }
}
