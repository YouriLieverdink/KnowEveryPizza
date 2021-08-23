<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check whether the user has the provided role.
        if (!Auth::user()->hasRole($role)) {

            return Response::json([
                'message' => 'You are unauthorized to make this request.',
                'data' => null,
            ], 403);
        }

        return $next($request);
    }
}
