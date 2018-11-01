<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Cart\Domain\Repositories\CartRepository;
class DeleteCartService extends Service {
    public function handle($productVariation = null , $cart = null) {
        $cart->delete($productVariation->id);
    }
}