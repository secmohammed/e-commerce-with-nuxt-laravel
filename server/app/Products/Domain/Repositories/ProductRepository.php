<?php

namespace App\Products\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Products\Domain\Models\Product;

class ProductRepository extends Repository {
    protected $model;
    public function __construct(Product $product) {
        $this->model = $product;
    }
}