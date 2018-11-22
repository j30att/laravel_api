<?php

namespace App\Http\Middleware;

use App\Models\Country;
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
        $countryId = Country::query()->where('code', $location)->pluck('id')->first();

        View::share('_location', $countryId);

        return $next($request);
    }
}
