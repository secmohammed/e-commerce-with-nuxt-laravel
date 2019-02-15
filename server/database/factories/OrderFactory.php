<?php

use App\Addresses\Domain\Models\Address;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use Faker\Generator as Faker;

$factory->define(App\Orders\Domain\Models\Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(Address::class)->create()->id,
        'shipping_method_id' => factory(ShippingMethod::class)->create()->id,
        'subtotal' => 100
    ];
});
