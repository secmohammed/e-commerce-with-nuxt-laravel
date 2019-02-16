<?php

namespace Tests\Unit\Listeners;

use App\Orders\Domain\Events\OrderPaid;
use App\Orders\Domain\Listeners\CreateTransaction;
use App\Orders\Domain\Listeners\MarkOrderPaymentFailed;
use App\Orders\Domain\Models\Order;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class CreateTransactionListenerTest extends TestCase
{
    /** @test */
    public function it_creates_a_transaction()
    {
        $event = new OrderPaid(
            $order = factory(Order::class)->create([
                'user_id' => factory(User::class)->create()
            ])
        );

        $listener = new CreateTransaction();
        $listener->handle($event);

        $this->assertDatabaseHas('transactions', [
            'order_id' => $order->id,
            'total' => $order->total()->amount()
        ]);
    }
}
