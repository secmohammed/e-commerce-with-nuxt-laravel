<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Services\Service;
class StoreCartService extends Service {
    public function handle($data = [], Cart $cart = null) {
        $cart->add($data['products']);
    }
}