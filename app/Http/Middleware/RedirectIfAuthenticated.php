<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role_name ==='superadmin') {
            return redirect()->route('admindashboard');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role_name==='seller'){
            return redirect()->route('sellerdashboard');
        }
        return $next($request);
    }
}
