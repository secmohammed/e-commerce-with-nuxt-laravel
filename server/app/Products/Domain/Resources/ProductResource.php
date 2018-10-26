<?php

namespace App\Products\Domain\Resources;

use App\ProductVariation\Domain\Resources\ProductVariationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends ProductIndexResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return array_merge(parent::toArray($request), [
            'variations' => ProductVariationResource::collection($this->variations->groupBy('type.name'))
        ]);
    }
}