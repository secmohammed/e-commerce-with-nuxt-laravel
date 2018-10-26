<?php

namespace App\Categories\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Categories\Domain\Resources\CategoryResource;

class IndexCategoriesResponder extends Responder implements ResponderInterface {
    public function respond() {
        return CategoryResource::collection(
            $this->response->getData()
        );
    }
}