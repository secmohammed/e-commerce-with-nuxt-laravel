<?php

namespace App\Cart\Actions;

use App\Cart\Domain\Services\IndexCartService;
use App\Cart\Responders\IndexCartResponder;
use Illuminate\Http\Request;

class IndexCartAction {
    public function __construct(IndexCartResponder $responder, IndexCartService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request) {
        return $this->responder->withResponse(
            $this->services->handle($request)
        )->respond();
    }
}