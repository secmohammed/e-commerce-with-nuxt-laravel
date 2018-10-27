<?php

namespace App\Orders\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Orders\Domain\Models\Order;

class OrderRepository extends Repository {
    protected $model;
    public function __construct(Order $order) {
        $this->model = $order;
    }
}