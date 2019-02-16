<?php

namespace App\PaymentMethods\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\PaymentMethods\Domain\Models\PaymentMethod;

class PaymentMethodRepository extends Repository {
    protected $model;
    public function __construct(PaymentMethod $paymentmethod) {
        $this->model = $paymentmethod;
    }
}