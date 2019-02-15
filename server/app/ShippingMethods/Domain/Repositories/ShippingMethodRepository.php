<?php

namespace App\ShippingMethods\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\ShippingMethods\Domain\Models\ShippingMethod;

class ShippingMethodRepository extends Repository {
    protected $model;
    public function __construct(ShippingMethod $shippingmethod) {
        $this->model = $shippingmethod;
    }
}