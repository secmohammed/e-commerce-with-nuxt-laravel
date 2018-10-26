<?php

use Faker\Generator as Faker;

$factory->define(App\Categories\Domain\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name,
        'slug' => str_slug($name)
    ];
});
