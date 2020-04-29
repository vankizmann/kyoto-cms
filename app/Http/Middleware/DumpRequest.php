<?php

namespace App\Http\Middleware;

class DumpRequest
{
    public function handle($request, \Closure $next)
    {
        dd($request);

        $next($request);
    }
}
