<?php

namespace App\Countries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Countries\Domain\Repositories\CountryRepository;
class IndexCountryService extends Service {
    protected $countries;
    public function __construct(CountryRepository $countries) {
        $this->countries = $countries;
    }
    public function handle($data = []) {
        return new GenericPayload($this->countries->all());
    }
}