<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check()) {
            if (Auth::user()->role == 3) {
                return $next($request);
            } else {
                return redirect('/home')->with('message', 'You do not have permissions to access this page');
            }
        } else {
            return redirect('/login')->with('message', 'Please Login or Register.');
        }
        return $next($request);
    }
}
