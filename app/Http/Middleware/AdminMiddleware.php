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
        if (auth()->user()->role === 'admin') {
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
