<?php

namespace App\ShippingMethods\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\ShippingMethods\Domain\Repositories\ShippingMethodRepository;
class Service extends Service {
    protected $shippingmethods;
    public function __construct(ShippingMethodRepository $shippingmethods) {
        $this->shippingmethods = $shippingmethods;
    }
    public function handle($data = []) {
        return new GenericPayload($this->shippingmethods->all());
    }
}