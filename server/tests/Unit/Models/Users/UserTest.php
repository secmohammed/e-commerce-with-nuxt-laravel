<?php

namespace Tests\Unit\Models\Users;

use App\Addresses\Domain\Models\Address;
use App\Orders\Domain\Models\Order;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_the_password_when_creating()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
       $this->assertNotEquals($user->password , 'cats');
    }
    /** @test */
    public function it_fetches_user_cart()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
        $user->cart()->attach(
            factory(ProductVariation::class)->create()
        );
        $this->assertInstanceOf(ProductVariation::class, $user->cart->first());
    }
    /** @test */
    public function it_has_a_quantity_for_each_product()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
        $user->cart()->attach(
            factory(ProductVariation::class)->create(),[
                'quantity' => $quantity = 5
            ]
        );
        $this->assertEquals($quantity, $user->cart->first()->pivot->quantity);
    }
    /** @test */
    public function it_has_many_addresses()
    {
        $user = factory(User::class)->create();
        $user->addresses()->save(
            factory(Address::class)->make()
        );
        $this->assertInstanceOf(Address::class, $user->addresses->first());
    }
    /** @test */
    public function it_has_many_orders()
    {
        $user = factory(User::class)->create();
        $user->orders()->save(
            factory(Order::class)->make()
        );
        $this->assertInstanceOf(Order::class, $user->orders->first());
    }
}
