<?php

namespace App\Orders\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Orders\Domain\Resources\OrderResource;

class IndexOrderResponder extends Responder implements ResponderInterface {
    public function respond() {
        return OrderResource::collection($this->response->getData());
    }
}
