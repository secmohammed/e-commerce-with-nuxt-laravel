<?php

namespace App\Cart\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Cart\Domain\Models\Cart;

class CartRepository extends Repository {
    protected $model;
    public function __construct(Cart $cart) {
        $this->model = $cart;
    }
}