<?php

namespace App\Addresses\Actions;

use App\Addresses\Domain\Requests\StoreAddressRequestForm;
use App\Addresses\Domain\Services\StoreAddressService;
use App\Addresses\Responders\StoreAddressResponder;

class StoreAddressAction {
    public function __construct(StoreAddressResponder $responder, StoreAddressService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(StoreAddressRequestForm $request) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}