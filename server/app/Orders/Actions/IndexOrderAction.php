<?php

namespace App\Orders\Actions;

use App\App\Actions\Action;
use App\Orders\Domain\Services\IndexOrderService;
use App\Orders\Responders\IndexOrderResponder;
use Illuminate\Http\Request;

class IndexOrderAction extends Action {
    public function __construct(IndexOrderResponder $responder, IndexOrderService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Request $request) {
        return $this->responder->withResponse(
            $this->services->handle($request)
        )->respond();
    }
}
