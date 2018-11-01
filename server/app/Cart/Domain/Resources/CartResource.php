<?php

namespace App\Cart\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'products' => CartProductVariationResource::collection($this->cart)
        ];
    }
}