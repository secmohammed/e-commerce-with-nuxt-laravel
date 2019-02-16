<?php

namespace App\App\Domain\Cart\Payments;

use App\PaymentMethods\Domain\Models\PaymentMethod;

interface GatewayCustomer
{
    public function charge(PaymentMethod $card, $amount);
    public function addCard($token);
    public function id();
}
