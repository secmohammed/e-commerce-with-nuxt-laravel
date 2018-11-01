<?php

namespace App\Addresses\Responders;

use App\Addresses\Domain\Resources\AddressResource;
use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class IndexAddressesResponder extends Responder implements ResponderInterface {
    public function respond() {
        return AddressResource::collection($this->response->getData());
    }
}