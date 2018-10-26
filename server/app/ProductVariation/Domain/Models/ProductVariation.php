<?php

namespace App\ProductVariation\Domain\Models;

use App\ProductVariationType\Domain\Models\ProductVariationType;
use App\Products\Domain\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public function type()
    {
        return $this->hasOne(ProductVariationType::class,'id','product_variation_type_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
