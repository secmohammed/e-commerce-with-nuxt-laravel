<?php

namespace App\Categories\Domain\Models;

use App\App\Domain\Traits\HasChildren;
use App\App\Domain\Traits\IsOrderable;
use App\Products\Domain\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasChildren,IsOrderable;
    protected $fillable = [
        'name',
        'slug',
        'order'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
