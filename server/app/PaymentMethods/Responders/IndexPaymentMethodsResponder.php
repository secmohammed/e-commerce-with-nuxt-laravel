<?php

namespace App\PaymentMethods\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\PaymentMethods\Domain\Resources\PaymentMethodResource;

class IndexPaymentMethodsResponder extends Responder implements ResponderInterface {
    public function respond() {
        return PaymentMethodResource::collection(
            $this->response->getData()
        );
    }
}
