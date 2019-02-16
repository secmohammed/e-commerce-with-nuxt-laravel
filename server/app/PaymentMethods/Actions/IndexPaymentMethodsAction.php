<?php

namespace App\PaymentMethods\Actions;

use App\App\Actions\Action;
use App\PaymentMethods\Domain\Services\IndexPaymentMethodsService;
use App\PaymentMethods\Responders\IndexPaymentMethodsResponder;
use Illuminate\Http\Request;

class IndexPaymentMethodsAction  extends Action {
    public function __construct(IndexPaymentMethodsResponder $responder, IndexPaymentMethodsService $services) {
        $this->middleware('auth:api');
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request) {
        return $this->responder->withResponse(
            $this->services->handle($request)
        )->respond();
    }
}
