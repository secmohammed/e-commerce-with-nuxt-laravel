<?php

namespace App\Countries\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Countries\Domain\Models\Country;

class CountryRepository extends Repository {
    protected $model;
    public function __construct(Country $country) {
        $this->model = $country;
    }
}