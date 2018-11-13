<?php

namespace App\Http\Middleware;

use App\Http\Services\PPValidate;
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
        $user = Auth::user();

        if (!is_null($user)){
            if ($partnerToken && $accountId){
                $user->pp_partner_token = $partnerToken;
                $user->pp_account_id = $accountId;
                $user->save();
                PPValidate::authentication($user);
            }
        }
        return $next($request);
    }
}
