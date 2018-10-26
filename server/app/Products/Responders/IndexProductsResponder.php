<?php

namespace App\Products\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Products\Domain\Resources\ProductIndexResource;

class IndexProductsResponder extends Responder implements ResponderInterface {
    public function respond() {
        return ProductIndexResource::collection($this->response->getData());
    }
}