<?php

namespace App\Orders\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Orders\Domain\Repositories\OrderRepository;
class IndexOrderService extends Service {
    protected $orders;
    public function __construct(OrderRepository $orders) {
        $this->orders = $orders;
    }
    public function handle($request = []) {
        $orders = $request->user()->orders()->with([
            'products',
            'products.stocks',
            'products.type',
            'products.product',
            'products.product.variations',
            'products.product.variations.stock',
            'address', 
            'shippingMethod'
        ])->latest()->paginate(10);
        return new GenericPayload($orders);
    }
}
