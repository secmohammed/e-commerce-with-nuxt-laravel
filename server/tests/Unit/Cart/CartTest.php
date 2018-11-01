<?php

namespace Tests\Unit\Cart;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Cart\Money;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /** @test */
    public function it_can_add_products_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $product = factory(ProductVariation::class)->create();
        $cart->add([
            ['id' => $product->id , 'quantity' => 1]
        ]);
        $this->assertCount(1 , $user->fresh()->cart);
    }
    /** @test */
    public function it_increments_quantity_when_adding_more_products()
    {
        $product = factory(ProductVariation::class)->create();
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $cart->add([
            ['id' => $product->id , 'quantity' => 1]
        ]);
        $cart = new Cart($user->fresh());
        $cart->add([
            ['id' => $product->id , 'quantity' => 1]
        ]);
        $this->assertEquals(2 , $user->fresh()->cart->first()->pivot->quantity);
    }
    /** @test */
    public function it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );
        $cart->update($product->id , 2);
        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity , 2);
    }
    /** @test */
    public function it_can_delete_a_product_from_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );
        $cart->delete($product->id);
        $this->assertCount(0 , $user->fresh()->cart);

           
    }
    /** @test */
    public function it_can_empty_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );
        $cart->empty($product->id);
        $this->assertCount(0 , $user->fresh()->cart);

           
    }
    /** @test */
    public function it_can_check_if_the_cart_is_empty_of_quantities()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 0
            ]
        );
        $this->assertTrue($cart->isEmpty());

           
    }
    /** @test */
    public function it_returns_a_money_instance_for_the_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }
    /** @test */
    public function it_returns_a_money_instance_for_the_total()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $this->assertInstanceOf(Money::class, $cart->total());
    }
    /** @test */
    public function it_gets_the_correct_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create([
                'price' => 1000
            ]),[
                'quantity' => 2
            ]
        );

        $this->assertEquals($cart->subtotal()->amount() , 2000);
    }
    /** @test */
    public function it_syncs_the_cart_to_update_quantity()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 2
            ]
        );
        $cart->sync();
        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 0);
    }
    /** @test */
    public function it_can_check_if_the_cart_has_changed_after_syncing()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 2
            ]
        );
        $cart->sync();
        $this->assertTrue($cart->hasChanged());
    }

}
