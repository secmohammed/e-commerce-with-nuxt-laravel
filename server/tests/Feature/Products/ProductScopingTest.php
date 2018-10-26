<?php

namespace Tests\Feature\Products;

use App\Categories\Domain\Models\Category;
use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductScopingTest extends TestCase
{
    /** @test */
    public function it_can_scope_by_category()
    {
        $product = factory(Product::class)->create();
        $product->categories()->save(
            $category = factory(Category::class)->create()
        );
        $anotherProduct = factory(Product::class)->create();
        $this->get("/api/products?category={$category->slug}")
        ->assertJsonCount(1 , 'data');
    }
}
