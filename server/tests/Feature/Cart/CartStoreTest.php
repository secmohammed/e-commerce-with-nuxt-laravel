<?php

namespace Tests\Feature\Cart;

use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_user_is_unauthenticated()
    {
        $this->post('/api/cart')->assertStatus(401);
    }
    /** @test */
    public function it_requires_products()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart')
        ->assertJsonValidationErrors(['products']);
    }
    /** @test */
    public function it_requires_products_to_be_an_array()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart', [
            'products' => 1
        ])
        ->assertJsonValidationErrors(['products']);
    }
    /** @test */
    public function it_requires_products_to_be_have_an_id()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart', [
            'products' => [
                ['quantity' => 1]
            ]
        ])
        ->assertJsonValidationErrors(['products.0.id']);
    }
    /** @test */
    public function it_requires_products_to_exist()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart', [
            'products' => [
                ['id' => 1,'quantity' => 1]
            ]
        ])
        ->assertJsonValidationErrors(['products.0.id']);
    }
    /** @test */
    public function it_requires_products_quantity_to_be_numeric()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart', [
            'products' => [
                ['id' => 1,'quantity' => 'abc']
            ]
        ])
        ->assertJsonValidationErrors(['products.0.quantity']);
    }
    /** @test */
    public function it_requires_products_quantity_to_be_at_least_one()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST','/api/cart', [
            'products' => [
                ['id' => 1,'quantity' => 0]
            ]
        ])
        ->assertJsonValidationErrors(['products.0.quantity']);
    }
    /** @test */
    public function it_can_add_products_to_the_users_cart()
    {
        $user = factory(User::class)->create();
        $product = factory(ProductVariation::class)->create();
        $response = $this->jsonAs($user, 'POST','/api/cart', [
            'products' => [
                ['id' => $product->id,'quantity' => 2]
            ]
        ]);
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => 2
        ]);
    }


}
