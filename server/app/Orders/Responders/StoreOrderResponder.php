<?php

namespace App\Orders\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Orders\Domain\Resources\OrderResource;

class StoreOrderResponder extends Responder implements ResponderInterface {
    public function respond() {
        if ($this->response->getStatus() != 200) {
            return response()->json($this->response->getData(), $this->response->getStatus());
        }
        return new OrderResource($this->response->getData());
    }
}
