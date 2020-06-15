<?php

namespace Kyoto\User\Http\Middleware;

class EnableGuardedMode
{
    public function handle($request, \Closure $next)
    {
        app('kyoto.user')->enableGuarded();

        return $next($request);
    }
}
