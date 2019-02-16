<?php

namespace App\PaymentMethods\Domain\Listeners;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Cart\Payments\Gateway;
use App\Orders\Domain\Events\OrderCreated;
use App\Orders\Domain\Events\OrderPaid;
use App\Orders\Domain\Events\OrderPaymentFailed;
use App\PaymentMethods\Domain\Exceptions\PaymentFailedException;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessPayment implements ShouldQueue
{
    protected $gateway;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        try {
            $this->gateway->withUser($order->user)->getCustomer()->charge(
                $order->paymentMethod, $order->total()->amount()
            );

            event(new OrderPaid($order));
        } catch (PaymentFailedException $e) {
            event(new OrderPaymentFailed($order));
            // we can send an email.
        }
    }
}
