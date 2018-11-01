<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Domain\Requests\StoreCartRequestForm;
use App\Cart\Domain\Services\StoreCartService;
use App\Cart\Responders\StoreCartResponder;

class StoreCartAction {
    public function __construct(StoreCartResponder $responder, StoreCartService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(StoreCartRequestForm $request , Cart $cart) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated(), $cart)
        )->respond();
    }
}