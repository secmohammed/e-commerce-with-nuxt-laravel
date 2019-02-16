<?php

namespace Tests\Unit\Listeners;

use App\App\Domain\Cart\Payments\Gateways\StripeGateway;
use App\App\Domain\Cart\Payments\Gateways\StripeGatewayCustomer;
use App\Orders\Domain\Events\OrderCreated;
use App\Orders\Domain\Events\OrderPaid;
use App\Orders\Domain\Events\OrderPaymentFailed;
use App\Orders\Domain\Models\Order;
use App\PaymentMethods\Domain\Exceptions\PaymentFailedException;
use App\PaymentMethods\Domain\Listeners\ProcessPayment;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\Users\Domain\Models\User;
use Event;
use Mockery;
use Tests\TestCase;
class ProcessPaymentListenerTest extends TestCase
{
    /** @test */
    public function it_charges_the_chosen_payment_the_correct_amount()
    {
        Event::fake();
        list($user, $payment, $order, $event) = $this->createEvent();
        list($gateway, $customer) = $this->mockFlow();
        $customer->shouldReceive('charge')->with(
            $order->paymentMethod, $order->total()->amount()
        );

        $listener = new ProcessPayment($gateway);
        $listener->handle($event);
    }
    /** @test */
    public function it_fires_the_order_paid_event()
    {
        Event::fake();
        list($user, $payment, $order, $event) = $this->createEvent();
        list($gateway, $customer) = $this->mockFlow();
        $customer->shouldReceive('charge')->with(
            $order->paymentMethod, $order->total()->amount()
        );
        $listener = new ProcessPayment($gateway);
        $listener->handle($event);

        Event::assertDispatched(OrderPaid::class, function ($event) use($order) {
            return $event->order->id == $order->id;
        });        
        
    }
    /** @test */
    public function it_fires_the_order_failed_event()
    {
        Event::fake();
        list($user, $payment, $order, $event) = $this->createEvent();
        list($gateway, $customer) = $this->mockFlow();
        $customer->shouldReceive('charge')->with(
            $order->paymentMethod, $order->total()->amount()
        )->andThrow(PaymentFailedException::class);
        $listener = new ProcessPayment($gateway);
        $listener->handle($event);

        Event::assertDispatched(OrderPaymentFailed::class, function ($event) use($order) {
            return $event->order->id == $order->id;
        });        
        
    }
    protected function createEvent()
    {
        $event = new OrderCreated(
            $order = factory(Order::class)->create([
                'user_id' => ($user = factory(User::class)->create())->id,
                'payment_method_id' => 
                    ($payment = factory(PaymentMethod::class)->create([
                        'user_id' => $user->id
                    ]))->id
            ])
        );
        return [$user, $payment, $order, $event];        
    }
    protected function mockFlow()
    {
        $gateway = Mockery::mock(StripeGateway::class);
        
        $gateway->shouldReceive('withUser')->andReturn($gateway)->shouldReceive('getCustomer')->andReturn(
            $customer = Mockery::mock(StripeGatewayCustomer::class)
        );
        return [$gateway, $customer];
    }
}
