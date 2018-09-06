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
            return response()->json([
                'code' => -1,
                'error' => '查询未开放',
                'data' => null
            ]);
        }
        return $next($request);
    }
}
