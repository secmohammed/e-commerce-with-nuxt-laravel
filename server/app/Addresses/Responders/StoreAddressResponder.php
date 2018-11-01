<?php

namespace App\Addresses\Responders;

use App\Addresses\Domain\Resources\AddressResource;
use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class StoreAddressResponder extends Responder implements ResponderInterface {
    public function respond() {
        return new AddressResource($this->response->getData());
    }
}