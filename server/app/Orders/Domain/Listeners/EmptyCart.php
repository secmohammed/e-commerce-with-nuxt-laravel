<?php

namespace App\Orders\Domain\Listeners;

use App\App\Domain\Cart\Cart;
use App\Orders\Domain\Events\OrderCreated;

class EmptyCart
{
    protected $cart;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle()
    {
        $this->cart->empty();
    }
}
