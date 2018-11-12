<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Integration
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
        $partnerToken = $request->get('partnerToken');
        $accountId = $request->get('accountId');

        if ($partnerToken && $accountId){
            $user = Auth::user();
            $user->pp_partner_token = $partnerToken;
            $user->pp_account_id = $accountId;
            $user->save();
        }

        return $next($request);
    }
}
