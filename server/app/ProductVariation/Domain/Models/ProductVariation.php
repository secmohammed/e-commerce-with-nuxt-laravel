<?php

namespace App\ProductVariation\Domain\Models;

use App\App\Domain\Cart\Money;
use App\App\Domain\Traits\HasPrice;
use App\ProductVariationType\Domain\Models\ProductVariationType;
use App\Products\Domain\Models\Product;
use App\Stocks\Domain\Models\Stock;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasPrice;
    public function type()
    {
        return $this->hasOne(ProductVariationType::class,'id','product_variation_type_id');
    }
    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }
    public function getPriceAttribute($value)
    {
        if (is_null($value)) {
            return $this->product->price;
        }
        return new Money($value);
    }
    public function minStock($amount)
    {
        return min($this->stock_count, $amount);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function stock()
    {
        return $this->belongsToMany(
            ProductVariation::class,'product_variation_stock_view'
        )->withPivot([
            'stock','total_stock','in_stock'
        ]);
    }
    public function getStockCountAttribute()
    {
        return $this->stock->sum('pivot.stock');
    }
    public function getInStockAttribute()
    {
        return $this->stock_count > 0;
    }
}
