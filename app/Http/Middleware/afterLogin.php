<?php

namespace App\Http\Middleware;

use Closure;

class afterLogin
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

        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        if (!empty($user)) {
            return back();
        }
        return $next($request);
    }
}
