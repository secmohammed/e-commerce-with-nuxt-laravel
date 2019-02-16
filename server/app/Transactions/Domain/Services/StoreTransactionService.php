<?php

namespace App\Transactions\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Transactions\Domain\Repositories\TransactionRepository;
class StoreTransactionService extends Service {
    protected $transactions;
    public function __construct(TransactionRepository $transactions) {
        $this->transactions = $transactions;
    }
    public function handle($data = []) {
        return new GenericPayload($this->transactions->all());
    }
}