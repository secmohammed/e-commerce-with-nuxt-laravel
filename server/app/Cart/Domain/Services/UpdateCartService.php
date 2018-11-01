<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Cart\Domain\Repositories\CartRepository;
use App\ProductVariation\Domain\Models\ProductVariation;
class UpdateCartService extends Service {
    public function handle($data = [] , ProductVariation $productVariation = null , Cart $cart = null) {
        $cart->update($productVariation->id , $data['quantity']);
    }
}