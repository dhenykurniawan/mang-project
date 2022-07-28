<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $access_roles = null)
    {
        if (!$request->session()->has('user_data')) {
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
