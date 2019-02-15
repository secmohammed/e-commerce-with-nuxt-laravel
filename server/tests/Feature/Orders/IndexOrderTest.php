<?php

namespace Tests\Feature\Orders;

use App\Orders\Domain\Models\Order;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexOrderTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $this->get('api/orders')->assertStatus(401);
    }
    /** @test */
    public function it_returns_a_collection_of_orders()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $this->jsonAs($user, 'GET', 'api/orders')->assertJsonFragment([
            'id' => $order->id
        ]);

    }
    /** @test */
    public function it_orders_by_the_latest_first()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);
        $anotherOrder = factory(Order::class)->create([
            'user_id' => $user->id,
            'created_at' => now()->subDay()
        ]);
        $this->jsonAs($user, 'GET', 'api/orders')->assertSeeInOrder([
            $order->created_at->toDateTimeString(),
            $anotherOrder->created_at->toDateTimeString()
        ]);

    }
    /** @test */
    public function it_has_pagination()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'GET', 'api/orders')->assertJsonStructure([
            'links',
            'meta'
        ]);

    }
}
