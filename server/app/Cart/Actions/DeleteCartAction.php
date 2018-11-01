<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Domain\Services\DeleteCartService;
use App\Cart\Responders\DeleteCartResponder;
use App\ProductVariation\Domain\Models\ProductVariation;

class DeleteCartAction {
    public function __construct(DeleteCartResponder $responder, DeleteCartService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(ProductVariation $productVariation , Cart $cart) {
        return $this->responder->withResponse(
            $this->services->handle($productVariation , $cart)
        )->respond();
    }
}