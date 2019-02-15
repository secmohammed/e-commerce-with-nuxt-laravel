<?php

namespace App\Addresses\Domain\Services;

use App\Addresses\Domain\Repositories\AddressRepository;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class IndexAddressShippingMethodsService extends Service {
    public function handle($address = null) {
        
        $this->authorize('show', $address);
        
        return new GenericPayload(
            $address->country->shippingMethods
        );
    }
}
