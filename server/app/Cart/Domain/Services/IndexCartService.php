<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Cart\Domain\Repositories\CartRepository;
class IndexCartService extends Service {
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }


    public function handle($request = []) {
        $this->cart->sync();
        $request->user()->load(['cart.product','cart.product.variations.stock','cart.stock','cart.type']);

        return new GenericPayload($request->user());
    }
}