<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserConfirmations;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\View;

class ConfirmRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->get('confirmationToken');
        $now = Carbon::now();

        if ($token) {
            $confirmReg = UserConfirmations::query()
                ->where('token', $token)->first();

            if (!$now->gte($confirmReg->expired_date)) {
                $user = User::query()->where('email', $confirmReg->email)->first();
                $user->active = 1;
                $user->save();
            }
        }

        return $next($request);
    }
}
