<?php

namespace App\Users\Actions;

use App\Users\Domain\Services\DeleteUserService;
use App\Users\Responders\DeleteUserResponder;

class DeleteUserAction {
    public function __construct(DeleteUserResponder $responder, DeleteUserService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}