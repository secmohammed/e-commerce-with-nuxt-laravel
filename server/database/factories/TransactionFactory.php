<?php

use Faker\Generator as Faker;

$factory->define(App\Transactions\Domain\Models\Transaction::class, function (Faker $faker) {
    return [
        'total' => 1000
    ];
});
