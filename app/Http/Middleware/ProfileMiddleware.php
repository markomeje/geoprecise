<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Models\{User, Profile};
use Closure;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (!empty($user->client)) {
            if (empty($user->client->status) || ($user->client->status ?? null) === 'incomplete') {
                if (strtoupper($request->method()) === 'GET') {
                    return redirect()->route('client.profile');
                }
            }
        }

        return $next($request);
    }
}
