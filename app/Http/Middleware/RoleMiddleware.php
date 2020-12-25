<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if(!auth()->user()->hasRole($role)) {
            abort(403);
        }
        if($permission !== null && !auth()->user()->can($permission)) {
            abort(403);
        }
        return $next($request);
    }
}
