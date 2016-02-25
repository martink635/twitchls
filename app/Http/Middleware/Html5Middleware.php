<?php namespace App\Http\Middleware;

use Closure;

class Html5Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->session()->has('html5')) {
            $request->session()->set('html5', true);
        }

        return $next($request);
    }

}
