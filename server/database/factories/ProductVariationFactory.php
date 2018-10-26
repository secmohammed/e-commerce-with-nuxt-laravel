<?php

use App\ProductVariationType\Domain\Models\ProductVariationType;
use App\Products\Domain\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\ProductVariation\Domain\Models\ProductVariation::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)->create()->id,
        'name' => $faker->unique()->name,
        'product_variation_type_id' => factory(ProductVariationType::class)->create()->id
    ];
});
