<?php

namespace App\PaymentMethods\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\PaymentMethods\Domain\Repositories\PaymentMethodRepository;
class IndexPaymentMethodsService extends Service {
    public function handle($request = []) {
        return new GenericPayload($request->user()->paymentMethods);
    }
}
