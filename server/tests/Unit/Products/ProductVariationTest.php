<?php

namespace Tests\Unit\Products;

use App\ProductVariationType\Domain\Models\ProductVariationType;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Models\Product;
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

}
