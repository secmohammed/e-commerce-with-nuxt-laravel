<?php

namespace App\Products\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Products\Domain\Resources\ProductResource;

class ShowProductResponder extends Responder implements ResponderInterface {
    public function respond() {
        return new ProductResource($this->response->getData());
    }
}