<?php

use Faker\Generator as Faker;

$factory->define(App\Stocks\Domain\Models\Stock::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween(10,100)
    ];
});
