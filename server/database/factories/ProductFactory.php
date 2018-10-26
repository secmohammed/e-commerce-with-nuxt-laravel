<?php

use Faker\Generator as Faker;

$factory->define(App\Products\Domain\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name,
        'slug' => str_slug($name),
        'price' => $faker->numberBetween(10,100),
        'description' => $faker->sentence(5)
    ];
});
