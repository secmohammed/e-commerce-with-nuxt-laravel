<?php

namespace App\Users\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Users\Domain\Resources\UserResource;

class LoginUserResponder extends Responder implements ResponderInterface {
    public function respond() {
        if ($this->response->getStatus() != 200) {
            return response()->json($this->response->getData(), $this->response->getStatus());
        }
        return (new UserResource(auth()->user()))
        ->additional([
            'meta' => [
                'token' => $this->response->getData()
            ]
        ]);
    }
}