<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware as Middleware;

class RedirectIfAuthenticated extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->checkForToken($request);

            return response()->json(['message' => 'You can not view this route, as you are having a token.']);
        } catch (\Exception $e) {
            return $next($request);
        }
    }
}
