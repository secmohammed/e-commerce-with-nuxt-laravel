<?php

namespace App\Orders\Actions;

use App\App\Actions\Action;
use App\Orders\Domain\Requests\StoreOrderRequest;
use App\Orders\Domain\Services\StoreOrderService;
use App\Orders\Responders\StoreOrderResponder;

class StoreOrderAction extends Action {
    public function __construct(StoreOrderResponder $responder, StoreOrderService $services) {
        $this->middleware(['cart.sync','cart.isnotempty']);
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(StoreOrderRequest $request) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
