<?php

namespace Tests\Feature\Cart;

use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartDeleteTest extends TestCase
{
    /** @test */
    public function it_fails_if_product_variation_not_found()
    {
        $this->delete('/api/cart/1')->assertStatus(404);
    }
    /** @test */
    public function it_deletes_an_item_from_the_cart()
    {
        $user = factory(User::class)->create();
        $user->cart()->sync(
            $product = factory(ProductVariation::class)->create()
        );
        $this->jsonAs($user , 'DELETE' , "api/cart/{$product->id}");
        $this->assertDatabaseMissing('cart_user',[
            'product_variation_id' => $product->id
        ]);
    }
}
