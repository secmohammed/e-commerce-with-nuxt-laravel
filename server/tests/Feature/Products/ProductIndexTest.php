<?php

namespace Tests\Feature\Products;

use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    /** @test */
    public function it_shows_a_collection_products()
    {
      $product = factory(Product::class)->create();
       $response = $this->get('/api/products')->assertJsonFragment([
        'id' => $product->id
       ]);
    }
    /** @test */
    public function it_has_paginated_data()
    {
        $this->get('/api/products')->assertJsonStructure([
            'meta'
        ]);
    }
}
