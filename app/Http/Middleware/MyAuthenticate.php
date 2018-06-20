<?php

namespace App\Http\Middleware;

use Closure;

class MyAuthenticate
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
        $listUser = config('parameters.listUser');

        if (isset($_COOKIE['user'])) {

            $listUser = config('parameters.listUser');
            $user = json_decode($_COOKIE['user']);

            if(!isset($listUser[$user->slug])) {

                return redirect()->route('admin-login');
            }
        } else {
            return redirect()->route('admin-login');
        }

        return $next($request);
    }
}
