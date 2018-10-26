<?php

namespace App\ProductVariation\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\ProductsVariation\Domain\Models\ProductsVariation;

class ProductVariationRepository extends Repository {
    protected $model;
    public function __construct(ProductsVariation $productsvariation) {
        $this->model = $productsvariation;
    }
}