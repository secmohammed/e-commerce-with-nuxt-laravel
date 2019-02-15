<?php

namespace App\ShippingMethods\Domain\Models;

use App\App\Domain\Traits\HasPrice;
use App\Countries\Domain\Models\Country;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasPrice;
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
