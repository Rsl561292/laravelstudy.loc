<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\User;

class VerificationRulesMiddleware
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
        //
        $user = Auth::user();

        if(stripos(URL::current(), '/admin')) {

            if(!Arr::exists(User::getRoleListForAdmin(), $user->role)) {

                Session::put('flash_message', [
                    [
                        'type' => 'error',
                        'message' => 'You don\'t right for entry in administration part site'
                    ]
                ]);

                return redirect()->back();
            }
        }

        return $next($request);
    }
}
