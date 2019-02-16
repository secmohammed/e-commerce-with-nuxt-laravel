<?php

namespace Tests\Unit\Listeners;

use App\App\Domain\Cart\Cart;
use App\Orders\Domain\Listeners\EmptyCart;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Models\Product;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmptyCartListenerTest extends TestCase
{
    /** @test */
    public function it_should_clear_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );
        $listener = new EmptyCart($cart);
        
        $listener->handle();

        $this->assertEmpty($user->cart);
    }
}
