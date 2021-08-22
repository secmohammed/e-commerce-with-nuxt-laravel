<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginFormRequest;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function login(UserLoginFormRequest $request)
    {
        if ($token = auth()->attempt($request->validated())) {
            return (new UserResource(auth()->user()))->additional([
                'meta' => [
                    'token' => $token,
                ],
            ]);
        }

        return response()->json(['message' => 'Invalid Credentials'], 422);
    }

    public function logout()
    {
        auth()->logout();
    }
}
