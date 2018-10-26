<?php

namespace App\ProductVariationType\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\ProductVariationType\Domain\Models\ProductVariationType;

class ProductVariationTypeRepository extends Repository {
    protected $model;
    public function __construct(ProductVariationType $productvariationtype) {
        $this->model = $productvariationtype;
    }
}