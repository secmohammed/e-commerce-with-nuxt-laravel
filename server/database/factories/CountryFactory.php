<?php

use Faker\Generator as Faker;

$factory->define(App\Countries\Domain\Models\Country::class, function (Faker $faker) {
    return [
        'code' => 'GB',
        'name' => 'United Kingdom'
    ];
});
