<?php

namespace App\Products\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\Products\Domain\Repositories\ProductRepository;
class ShowProductService implements ServiceInterface {
    public function handle($product = null) {
        $product->load(['variations.type','variations.stock','variations.product']);
        return new GenericPayload($product);
    }
}