<?php

use Faker\Generator as Faker;

$factory->define(App\ShippingMethods\Domain\Models\ShippingMethod::class, function (Faker $faker) {
    return [
        'name' => 'Royal Mail',
        'price' => 1000
    ];
});
