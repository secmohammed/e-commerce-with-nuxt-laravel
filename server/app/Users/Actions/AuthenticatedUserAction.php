<?php

namespace App\Users\Actions;

use App\Users\Domain\Services\AuthenticatedUserService;
use App\Users\Responders\AuthenticatedUserResponder;
use Illuminate\Http\Request;

class AuthenticatedUserAction {
    public function __construct(AuthenticatedUserResponder $responder, AuthenticatedUserService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request) {
        return $this->responder->withResponse(
            $this->services->handle($request->user())
        )->respond();
    }
}