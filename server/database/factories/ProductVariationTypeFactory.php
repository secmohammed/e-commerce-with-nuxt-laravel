<?php

use Faker\Generator as Faker;

$factory->define(App\ProductVariationType\Domain\Models\ProductVariationType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name
    ];
});
