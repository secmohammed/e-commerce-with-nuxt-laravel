<?php

namespace App\PaymentMethods\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\PaymentMethods\Domain\Resources\PaymentMethodResource;

class StorePaymentMethodResponder extends Responder implements ResponderInterface {
    public function respond() {
        return new PaymentMethodResource($this->response->getData());
    }
}
