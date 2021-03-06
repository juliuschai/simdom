<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AdminOrOwnerMiddleware
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

        // cari id pemilik dari domain/permintaan yang direquest
        $owner_id = '';
        $params = $request->route()->parameters();
        if (array_key_exists('domain', $params)) {
            $owner_id = $params['domain']->user_id;
        } elseif (array_key_exists('permintaan', $params)) {
            $owner_id = $params['permintaan']->user_id;
        } elseif (array_key_exists('server', $params)) {
            $owner_id = $params['server']->user_id;
        }

        if ($owner_id == auth()->id()) {
            return $next($request);
        }

        abort(403);
    }
}
