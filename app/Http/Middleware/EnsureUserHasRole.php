<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roleName)
    {
        $user = Auth::user();

        // Check whether the user has the role.
        $hasRole = false;

        foreach ($user->roles()->get() as $role) {
            // Check whether this user has the provided role.
            if ($role->title == $roleName) {

                $hasRole = true;
            }
        }

        if (!$hasRole) {

            return Response::json([
                'message' => 'You are unauthorized to make this request.',
                'data' => null,
            ], 403);
        }

        // The user is authorized to continue.
        return $next($request);
    }
}
