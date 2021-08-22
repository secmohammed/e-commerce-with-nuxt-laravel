<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function register(UserRegisterFormRequest $request)
    {
        $user = $this->users->create($request->validated());

        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $user->generateAuthToken(),
            ],
        ]);
    }
}
