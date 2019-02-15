<?php

use App\Countries\Domain\Models\Country;
use App\Users\Domain\Models\User;
use Faker\Generator as Faker;

$factory->define(App\Addresses\Domain\Models\Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address_1' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country_id' => factory(Country::class)->create()->id,
        'user_id' => factory(User::class)->create()->id
    ];
});
