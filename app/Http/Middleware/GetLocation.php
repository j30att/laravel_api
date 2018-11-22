<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class GetLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locationGeo = geoip()->getLocation($request->getClientIp());
        $location = $locationGeo->iso_code;
        View::share('_location', $location);

        return $next($request);
    }
}
