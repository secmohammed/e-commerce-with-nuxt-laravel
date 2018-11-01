<?php

namespace App\Addresses\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Addresses\Domain\Models\Address;

class AddressRepository extends Repository {
    protected $model;
    public function __construct(Address $address) {
        $this->model = $address;
    }
}