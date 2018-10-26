<?php

namespace Tests\Feature\Products;

use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    /** @test */
    public function it_fails_if_a_product_cant_be_found()
    {
        $this->get('/api/products/nope')->assertStatus(404);
    }
    /** @test */
    public function it_shows_a_product()
    {
        $product = factory(Product::class)->create();
        $this->get("/api/products/{$product->slug}")->assertJsonFragment([
            'id' => $product->id
        ]);
           
    }
}
