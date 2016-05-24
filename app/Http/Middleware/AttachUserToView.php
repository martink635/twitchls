<?php

namespace App\Http\Middleware;

use Closure;

class AttachUserToView {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');

            $request->setUserResolver(function() use ($user) {
                return $user;
            });

            view()->share('user', $user);
        }

        return $next($request);
    }

}
