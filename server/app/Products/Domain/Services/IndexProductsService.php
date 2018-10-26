<?php

namespace App\Products\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\Products\Domain\Repositories\ProductRepository;
use App\Products\Domain\Scoping\Scopes\CategoryScope;
class IndexProductsService implements ServiceInterface {
    protected $products;
    public function __construct(ProductRepository $products) {
        $this->products = $products;
    }
    public function handle($data = []) {
        return new GenericPayload($this->products->withScopes($this->scopes())->paginate(10));
    }
    protected function scopes()
    {
        return [
            'category' => new CategoryScope
        ];
    }
}