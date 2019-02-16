<?php

namespace App\Transactions\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Transactions\Domain\Models\Transaction;

class TransactionRepository extends Repository {
    protected $model;
    public function __construct(Transaction $transaction) {
        $this->model = $transaction;
    }
}