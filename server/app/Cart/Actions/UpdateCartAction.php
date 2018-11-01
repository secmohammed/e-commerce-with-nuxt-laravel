<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Domain\Requests\UpdateCartRequestForm;
use App\Cart\Domain\Services\UpdateCartService;
use App\Cart\Responders\UpdateCartResponder;
use App\ProductVariation\Domain\Models\ProductVariation;

class UpdateCartAction {
    public function __construct(UpdateCartResponder $responder, UpdateCartService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(UpdateCartRequestForm $request , ProductVariation $productVariation , Cart $cart) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated() , $productVariation , $cart)
        )->respond();
    }
}