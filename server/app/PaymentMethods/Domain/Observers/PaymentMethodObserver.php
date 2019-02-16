<?php

namespace App\PaymentMethods\Domain\Observers;

use App\PaymentMethods\Domain\Models\PaymentMethod;


class PaymentMethodObserver
{
    public function creating(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->default) {
            $paymentMethod->user->paymentMethods()->update([
                'default' => false
            ]);
        }
    }
}
