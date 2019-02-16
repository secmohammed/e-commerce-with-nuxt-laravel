<?php

namespace App\Transactions\Actions;

use App\Transactions\Domain\Services\StoreTransactionService;
use App\Transactions\Responders\StoreTransactionResponder;

class StoreTransactionAction {
    public function __construct(StoreTransactionResponder $responder, StoreTransactionService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}