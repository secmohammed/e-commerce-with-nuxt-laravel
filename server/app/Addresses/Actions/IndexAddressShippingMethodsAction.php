<?php

namespace App\Addresses\Actions;

use App\Addresses\Domain\Models\Address;
use App\Addresses\Domain\Services\IndexAddressShippingMethodsService;
use App\Addresses\Responders\IndexAddressShippingMethodsResponder;
use App\App\Actions\Action;
use Illuminate\Routing\Controller;

class IndexAddressShippingMethodsAction  extends Action {
    public function __construct(IndexAddressShippingMethodsResponder $responder, IndexAddressShippingMethodsService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Address $address) {
        return $this->responder->withResponse(
            $this->services->handle($address)
        )->respond();
    }
}
