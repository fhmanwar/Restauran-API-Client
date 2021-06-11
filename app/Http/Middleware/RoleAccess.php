<?php

namespace App\Http\Middleware;

use Closure;

class RoleAccess
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
        // return $next($request);
        if (session('roleName') == 'Administrator') {
            return $next($request);
        } elseif (session('roleName') == 'Pelanggan') {
            return redirect()->route('home');
        } else {
            // return abort(403);
            return abort(404);
        }
    }
}
