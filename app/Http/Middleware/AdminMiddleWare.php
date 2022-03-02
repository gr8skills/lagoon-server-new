<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authenticated = Auth::check();
        if (!$authenticated) {
            return redirect()->route('login');
        }
        if (Auth::user()->roles()->first()->title !== 'admin') {
            return redirect()->route('unauthorized');
        }
        return $next($request);
    }
}
