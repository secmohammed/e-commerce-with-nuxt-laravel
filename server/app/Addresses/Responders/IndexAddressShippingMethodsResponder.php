<?php

namespace App\Addresses\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\ShippingMethods\Domain\Resources\ShippingMethodResource;

class IndexAddressShippingMethodsResponder extends Responder implements ResponderInterface {
    public function respond() {
        return ShippingMethodResource::collection($this->response->getData());
    }
}
