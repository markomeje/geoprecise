<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class AdminMiddleware
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
        if (in_array(auth()->user()->role, ['admin', 'developer', 'superadmin'])) {
            return $next($request);
        }

        if (auth()->check()) {
            auth()->logout();
            $request->session()->flush();
            $request->session()->invalidate();
        }
            
        return redirect()->route('login');
    }
}
