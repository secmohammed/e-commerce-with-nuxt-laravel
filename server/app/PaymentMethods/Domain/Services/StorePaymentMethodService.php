<?php

namespace App\PaymentMethods\Domain\Services;

use App\App\Domain\Cart\Payments\Gateway;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\PaymentMethods\Domain\Repositories\PaymentMethodRepository;
class StorePaymentMethodService extends Service {
    protected $gateway;
    public function __construct(Gateway $gateway) {
        $this->gateway = $gateway;
    }
    public function handle($data = []) {
       $card = $this->gateway->withUser(auth()->user())->createCustomer()->addCard($data);
        return new GenericPayload($card);
    }
}
