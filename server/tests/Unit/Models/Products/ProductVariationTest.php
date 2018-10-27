<?php

namespace Tests\Unit\Models\Products;

use App\App\Domain\Cart\Money;
use App\ProductVariationType\Domain\Models\ProductVariationType;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Models\Product;
use App\Stocks\Domain\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductVariationTest extends TestCase
{
    /** @test */
    public function it_has_one_variation()
    {
        $variation = factory(ProductVariation::class)->create();
        $this->assertInstanceOf(ProductVariationType::class,$variation->type);
    }
    /** @test */
    public function it_belongs_to_a_product()
    {
        $variation = factory(ProductVariation::class)->create();
        $this->assertInstanceOf(Product::class,$variation->product);
    }
    /** @test */
    public function it_retruns_a_money_instance_for_the_price()
    {
        $variation = factory(ProductVariation::class)->create();
        $this->assertInstanceOf(Money::class, $variation->price);
    }
    /** @test */
    public function it_returns_a_formatted_price()
    {
        $variation = factory(ProductVariation::class)->create([
            'price' => 1000
        ]);
        $this->assertEquals($variation->formattedPrice , '£10.00');
    }
    /** @test */
    public function it_returns_the_product_price_if_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);
        $variation = factory(ProductVariation::class)->create([
            'price' => null,
            'product_id' => $product->id
        ]);
        $this->assertEquals($product->price->amount() , $variation->price->amount());
    }
    /** @test */
    public function it_can_check_if_the_variation_price_is_different_to_the_product_price()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);
        $variation = factory(ProductVariation::class)->create([
            'price' => 2000,
            'product_id' => $product->id
        ]);
        $this->assertTrue($variation->priceVaries());
    }
    /** @test */
    public function it_has_many_stocks()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertInstanceOf(Stock::class,$variation->stocks->first());
    }
    /** @test */
    public function it_has_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertInstanceOf(ProductVariation::class,$variation->stock->first());
    }
    /** @test */
    public function it_has_stock_count_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );
        $this->assertEquals($variation->stock->first()->pivot->stock , $quantity);
    }
    /** @test */
    public function it_has_in_stock_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );
        $this->assertTrue($variation->stock->first()->pivot->in_stock);
    }
    /** @test */
    public function it_checks_if_it_is_in_stock()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );
        $this->assertTrue($variation->in_stock);
    }
    /** @test */
    public function it_fetches_the_stock_count()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );
        $this->assertEquals($variation->stock_count , 10);           
    }
}
