<?php

use App\Addresses\Domain\Models\Address;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use App\Users\Domain\Models\User;
use Faker\Generator as Faker;

$factory->define(App\Orders\Domain\Models\Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(Address::class)->create()->id,
        'shipping_method_id' => factory(ShippingMethod::class)->create()->id,
        'subtotal' => 100,
        'payment_method_id' => factory(PaymentMethod::class)->create([
            'user_id' => factory(User::class)->create()->id
        ])->id
    ];
});
