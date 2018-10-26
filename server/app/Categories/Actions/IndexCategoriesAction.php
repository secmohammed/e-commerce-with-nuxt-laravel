<?php

namespace App\Categories\Actions;

use App\Categories\Domain\Services\IndexCategoriesService;
use App\Categories\Responders\IndexCategoriesResponder;

class IndexCategoriesAction {
    public function __construct(IndexCategoriesResponder $responder, IndexCategoriesService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke() {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}