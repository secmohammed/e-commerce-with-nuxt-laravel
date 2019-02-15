<?php

namespace Tests\Unit\Collections;

use App\ProductVariation\Domain\Collections\ProductVariationCollection;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductVariationCollectionTest extends TestCase
{
    /** @test */
    public function it_can_get_a_syncing_array()
    {
        $user = factory(User::class)->create();
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => $quantity = 2
            ]
        );
        $collection = new ProductVariationCollection($user->cart);
        $this->assertEquals($collection->forSyncing(), [
            $product->id => compact('quantity')
        ]);
    }
}
