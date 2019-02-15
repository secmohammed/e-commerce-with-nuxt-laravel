<?php

namespace App\Orders\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Orders\Domain\Events\OrderCreated;
use App\Orders\Domain\Repositories\OrderRepository;
use App\ProductVariation\Domain\Models\ProductVariation;
class StoreOrderService extends Service {
    protected $orders;
    public function __construct(Cart $cart) {
        $this->cart = $cart;
    }
    public function handle($data = []) {
        $order = auth()->user()->orders()->firstOrCreate(
            $this->prepareOrder($data)
        );
        $order->products()->sync($this->cart->products()->forSyncing());
        event(new OrderCreated($order));
        return new GenericPayload($order);
    }
    protected function prepareOrder($data)
    {
        return array_merge($data,[
            'subtotal' => $this->cart->subtotal()->amount()
        ]);
    }
}
