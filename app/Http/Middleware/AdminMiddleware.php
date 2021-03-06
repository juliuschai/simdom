<?php

namespace App\Http\Middleware;

use App\User;
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
    public function handle($request, Closure $next)
    {
        // If user is admin
        $user = User::findOrLogout(auth()->id());
        if ($user->role == 'admin') {
            return $next($request);
        }

        abort(403);
    }
}
