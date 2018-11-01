<?php

namespace App\Addresses\Actions;

use App\Addresses\Domain\Services\IndexAddressesService;
use App\Addresses\Responders\IndexAddressesResponder;
use Illuminate\Http\Request;

class IndexAddressesAction {
    public function __construct(IndexAddressesResponder $responder, IndexAddressesService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request) {
        return $this->responder->withResponse(
            $this->services->handle($request->user())
        )->respond();
    }
}