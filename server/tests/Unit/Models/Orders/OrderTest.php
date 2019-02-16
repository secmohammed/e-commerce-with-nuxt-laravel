<?php

namespace Tests\Unit\Models\Orders;

use App\Addresses\Domain\Models\Address;
use App\App\Domain\Cart\Money;
use App\Orders\Domain\Models\Order;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use App\Transactions\Domain\Models\Transaction;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function it_belongs_a_user()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(User::class, $order->user);
    }
    /** @test */
    public function it_belongs_an_address()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(Address::class, $order->address);
    }
    /** @test */
    public function it_belongs_a_shipping_method()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(ShippingMethod::class, $order->shippingMethod);
    }
    /** @test */
    public function it_belongs_a_payment_method()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(PaymentMethod::class, $order->paymentMethod);
    }
    /** @test */
    public function it_has_many_products()
    {
        $order = factory(Order::class)->create([

            'user_id' => factory(User::class)->create()->id
        ]);
        $order->products()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );
        $this->assertInstanceOf(ProductVariation::class, $order->products->first());
    }

    /** @test */
    public function it_has_many_transactions()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $order->transactions()->save(
            factory(Transaction::class)->make([
                'order_id' => $order->id
            ])
        );
        $this->assertInstanceOf(Transaction::class, $order->transactions->first());
    }

    /** @test */
    public function it_has_a_quantity_attached_to_the_products()
    {
        $order = factory(Order::class)->create([

            'user_id' => factory(User::class)->create()->id
        ]);
        $order->products()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => $quantity = 1
            ]
        );
        $this->assertEquals($order->products->first()->pivot->quantity, $quantity);
    }
    
    /** @test */
    public function it_has_a_default_status_of_pending()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertEquals($order->status, Order::PENDING);
    }
    /** @test */
    public function it_returns_a_money_instance_for_subtotal()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(Money::class, $order->subtotal);        
    }
    /** @test */
    public function it_returns_a_money_instance_for_total()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(Money::class, $order->total());        
        
    }
    /** @test */
    public function it_adds_shipping_onto_the_total()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
            'subtotal' => 1000,
            'shipping_method_id' => factory(ShippingMethod::class)->create([
                'price' => 1000
            ])
        ]);
        $this->assertEquals($order->total()->amount(), 2000);   
    }
}
