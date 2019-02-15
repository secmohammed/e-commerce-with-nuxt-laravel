<?php

namespace App\ProductVariation\Domain\Collections;

use Illuminate\Database\Eloquent\Collection;

class ProductVariationCollection extends Collection
{
    public function forSyncing()
    {
        return $this->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product->pivot->quantity
            ];
        })->toArray();
    }
}
