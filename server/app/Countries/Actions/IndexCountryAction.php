<?php

namespace App\Countries\Actions;

use App\Countries\Domain\Services\IndexCountryService;
use App\Countries\Responders\IndexCountryResponder;

class IndexCountryAction {
    public function __construct(IndexCountryResponder $responder, IndexCountryService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}