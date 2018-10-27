<?php

namespace App\Products\Domain\Models;

use App\App\Domain\Traits\CanBeScoped;
use App\App\Domain\Traits\HasPrice;
use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use CanBeScoped,HasPrice;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getInStockAttribute()
    {
        return $this->stock_count > 0;
    }
    public function getStockCountAttribute()
    {
        return $this->variations->sum(function($variation){
            return $variation->stock_count;
        });
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order','asc');
    }
}
