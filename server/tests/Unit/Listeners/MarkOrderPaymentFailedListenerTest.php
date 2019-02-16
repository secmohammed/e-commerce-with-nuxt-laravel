<?php

namespace Tests\Unit\Listeners;

use App\Orders\Domain\Events\OrderPaymentFailed;
use App\Orders\Domain\Listeners\MarkOrderPaymentFailed;
use App\Orders\Domain\Models\Order;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class MarkOrderPaymentFailedListenerTest extends TestCase
{
    /** @test */
    public function it_marks_order_as_payment_failed()
    {
        $event = new OrderPaymentFailed(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()
            ])
        );

        $listener = new MarkOrderPaymentFailed();
        $listener->handle($event);
        $this->assertEquals($order->fresh()->status, Order::PAYMENT_FAILED);
    }
}
