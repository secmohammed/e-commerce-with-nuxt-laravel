<?php

namespace App\Stocks\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Stocks\Domain\Models\Stock;

class StockRepository extends Repository {
    protected $model;
    public function __construct(Stock $stock) {
        $this->model = $stock;
    }
}