<?php

namespace App\Countries\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Countries\Domain\Resources\CountryResource;

class IndexCountryResponder extends Responder implements ResponderInterface {
    public function respond() {
        return CountryResource::collection($this->response->getData());
    }
}
