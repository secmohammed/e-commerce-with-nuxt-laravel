<?php

namespace App\Orders\Domain\Listeners;

use App\Orders\Domain\Events\OrderPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTransaction
{

    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $event->order->transactions()->create([
            'total' => $event->order->total()->amount()
        ]);
    }
}
