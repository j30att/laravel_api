<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;

class checkAgent
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
        $agent = new Agent();
        $agent->isMobile();
        $typeDevice = 'mobile';


        if ($agent->isMobile() || $agent->isTablet()){
            $typeDevice = 'mobile';
            $request->attributes->add(['typeDevice' => 'mobile']);
        } else{
            $typeDevice = 'desktop';
            $request->attributes->add(['typeDevice' => 'desktop']);
        }

        View::share('_typeDevice', $typeDevice);

        return $next($request);
    }
}
