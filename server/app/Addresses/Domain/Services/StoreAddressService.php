<?php

namespace App\Addresses\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Addresses\Domain\Repositories\AddressRepository;
class StoreAddressService extends Service {
    protected $addresses;
    public function __construct(AddressRepository $addresses) {
        $this->addresses = $addresses;
    }
    public function handle($data = []) {
        $address = $this->addresses->make($data);
        auth()->user()->addresses()->save($address);
        return new GenericPayload($address);
    }
}