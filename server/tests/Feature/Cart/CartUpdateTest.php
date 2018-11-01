<?php

namespace Tests\Feature\Cart;

use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartUpdateTest extends TestCase
{
    /** @test */
    public function it_fails_if_product_variation_not_found()
    {
        $this->put('/api/cart/1')->assertStatus(404);
    }
    /** @test */
    public function it_requires_a_quantity()
    {
        $user = factory(User::class)->create();
        $product = factory(ProductVariation::class)->create();
        $response = $this->jsonAs($user , 'PUT',"api/cart/{$product->id}");
        $this->assertJsonValidationMessages($response ,[
            'quantity' => "The quantity field is required."
        ]);
    }
    /** @test */
    public function it_requires_a_numeric_quantity()
    {
        $user = factory(User::class)->create();
        $product = factory(ProductVariation::class)->create();
        $response = $this->jsonAs($user , 'PUT',"api/cart/{$product->id}", [
            'quantity' => 'one'
        ]);
        $this->assertJsonValidationMessages($response ,[
            'quantity' => "The quantity must be a number."
        ]);
    }
    /** @test */
    public function it_requires_a_numeric_quantity_of_one_or_more()
    {
        $user = factory(User::class)->create();
        $product = factory(ProductVariation::class)->create();
        $response = $this->jsonAs($user , 'PUT',"api/cart/{$product->id}", [
            'quantity' => 0
        ]);
        $this->assertJsonValidationMessages($response ,[
            'quantity' => "The quantity must be at least 1."
        ]);
    }
    /** @test */
    public function it_updates_the_quantity_of_a_product()
    {
        $user = factory(User::class)->create();
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 1
            ]
        );
        $response = $this->jsonAs($user , 'PUT',"api/cart/{$product->id}", [
            'quantity' => $quantity = 5
        ]);
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => $quantity
        ]);
    }


}
