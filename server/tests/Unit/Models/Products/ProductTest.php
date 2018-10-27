<?php

namespace Tests\Unit\Models\Products;

use App\App\Domain\Cart\Money;
use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Models\Product;
use App\Stocks\Domain\Models\Stock;
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
    /** @test */
    public function it_retruns_a_money_instance_for_the_price()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Money::class, $product->price);
    }
    /** @test */
    public function it_returns_a_formatted_price()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);
        $this->assertEquals($product->formattedPrice , '£10.00');
    }
    /** @test */
    public function it_can_check_if_its_in_stock()
    {
        $product = factory(Product::class)->create();
        $product->variations()->save(
            $variation = factory(ProductVariation::class)->create()
        );
        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertTrue($product->in_stock);
    }
    /** @test */
    public function it_gets_the_stock_count()
    {
        $product = factory(Product::class)->create();
        $product->variations()->save(
            $variation = factory(ProductVariation::class)->create()
        );
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );
        $this->assertEquals($product->stock_count , 5);
    }
}
