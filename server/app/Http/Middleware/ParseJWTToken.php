<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class ParseJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if ($this->checkIfUserHasToken()) {
                \JWTAuth::parseToken()->authenticate();
            }
        } catch (TokenExpiredException $e) {
            // If the token is expired, then it will be refreshed and added to the headers
            try {
                $this->refreshUserToken();
            } catch (JWTException $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }

        return $next($request);
    }

    protected function checkIfUserHasToken()
    {
        if ($this->isAuthenticatedWithoutHeader()) {
            $this->setAuthorizationHeader();
        }

        return request()->headers->has('Authorization');
    }

    protected function isAuthenticatedWithoutHeader()
    {
        return auth()->check() && !request()->headers->has('Authorization');
    }

    protected function refreshUserToken()
    {
        auth('api')->setToken(auth('api')->refresh());
        $this->setAuthorizationHeader();
    }

    protected function setAuthorizationHeader()
    {
        request()->headers->set('Authorization', 'Bearer '.auth('api')->getToken());
    }
}
