<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class ClientMiddleware
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
        if('client' === auth()->user()->role){
            return $next($request);
        }

        return route('login');
    }
}
