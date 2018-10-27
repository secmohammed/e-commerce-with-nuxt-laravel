<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\Users\Domain\Repositories\UserRepository;
class AuthenticatedUserService implements ServiceInterface {
    public function handle($user = []) {
        return new GenericPayload($user);
    }
}