<?php

namespace App\Http\Middleware;

use Closure;

class TimeLimit
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
        if (env('TIME')) {
            return redirect('time');
        }
        return $next($request);
    }
}
