<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class RestrictApiUser
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
        auth()->shouldUse('web');

        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'error' => 'Invalid token'
                ] , 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 500);
        }
        return $next($request);
    }
}
