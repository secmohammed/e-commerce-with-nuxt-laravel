<?php

namespace App\Orders\Domain\Listeners;

use App\Orders\Domain\Events\OrderPaid;
use App\Orders\Domain\Models\Order;

class MarkOrderProcessing
{

    /**
     * Handle the event.
     *
     * @param  OrderPaymentFailed  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $event->order->update([
            'status' => Order::PROCESSING
        ]);
    }
}
