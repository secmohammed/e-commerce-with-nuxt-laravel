<?php

namespace Tests\Unit\Listeners;

use App\Orders\Domain\Events\OrderPaid;
use App\Orders\Domain\Listeners\MarkOrderProcessing;
use App\Orders\Domain\Models\Order;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class MarkOrderProcessingListenerTest extends TestCase
{
    /** @test */
    public function it_marks_order_as_processing()
    {
        $event = new OrderPaid(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()
            ])
        );

        $listener = new MarkOrderProcessing();
        $listener->handle($event);
        $this->assertEquals($order->fresh()->status, Order::PROCESSING);
    }
}
