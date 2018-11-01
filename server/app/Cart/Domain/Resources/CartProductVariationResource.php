<?php

namespace App\Cart\Domain\Resources;

use App\App\Domain\Cart\Money;
use App\ProductVariation\Domain\Resources\ProductVariationResource;
use App\Products\Domain\Resources\ProductIndexResource;

class CartProductVariationResource extends ProductVariationResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return array_merge(parent::toArray($request),[
            'product' => new ProductIndexResource($this->product),
            'quantity' => $this->pivot->quantity,
            'total' => $this->getTotal()->formatted()
        ]);
    }
    protected function getTotal()
    {
        return  new Money($this->pivot->quantity * $this->price->amount());        
    }
}