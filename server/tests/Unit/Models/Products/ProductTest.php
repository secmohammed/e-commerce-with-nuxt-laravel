<?php

namespace Tests\Unit\Models\Products;

use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product;
        $this->assertEquals($product->getRouteKeyName() , 'slug');
    }
    /** @test */
    public function it_has_many_categories()
    {
        $product = factory(Product::class)->create();
        $product->categories()->save(
            factory(Category::class)->create()
        );
        $this->assertInstanceOf(Category::class, $product->categories->first());
    }
    /** @test */
    public function it_has_many_variations()
    {
        $product = factory(Product::class)->create();
        $product->variations()->save(
            factory(ProductVariation::class)->create([
                'product_id' => $product->id
            ])
        );
        $this->assertInstanceOf(ProductVariation::class ,$product->variations->first());
    }
}
