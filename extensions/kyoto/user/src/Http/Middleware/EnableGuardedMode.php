<?php

namespace Kyoto\User\Http\Middleware;

use Kyoto\User\Facades\KyotoUser;

class EnableGuardedMode
{

    public function handle($request, \Closure $next)
    {
        KyotoUser::enableGuard();

        return $next($request);
    }

}
