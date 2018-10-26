<?php

namespace App\Products\Domain\Models;

use App\App\Domain\Traits\CanBeScoped;
use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\Products\Domain\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CanBeScoped;
    public function getRouteKeyName()
    {
        return 'slug';
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
