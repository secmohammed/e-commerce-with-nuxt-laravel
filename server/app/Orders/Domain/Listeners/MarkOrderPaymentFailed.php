<?php

namespace App\Orders\Domain\Listeners;

use App\Orders\Domain\Events\OrderPaymentFailed;
use App\Orders\Domain\Models\Order;

class MarkOrderPaymentFailed
{

    /**
     * Handle the event.
     *
     * @param  OrderPaymentFailed  $event
     * @return void
     */
    public function handle(OrderPaymentFailed $event)
    {
        $event->order->update([
            'status' => Order::PAYMENT_FAILED
        ]);
    }
}
