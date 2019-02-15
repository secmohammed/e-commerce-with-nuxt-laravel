<?php

namespace App\Addresses\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Addresses\Domain\Repositories\AddressRepository;
class IndexAddressesService extends Service {
    public function handle($user = null) {
        return new GenericPayload($user->addresses);
    }
}
