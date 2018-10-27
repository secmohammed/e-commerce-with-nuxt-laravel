<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\Users\Domain\Repositories\UserRepository;
class LoginUserService implements ServiceInterface {
    protected $users;
    public function __construct(UserRepository $users) {
        $this->users = $users;
    }
    public function handle($data = []) {
        if (!$token = auth()->attempt($data)) {
            return new UnauthorizedPayload([
                'errors' => [ 'emai' => 'Could not sign you in with those details.']
            ]);
        }

        return new GenericPayload($token);
    }
}