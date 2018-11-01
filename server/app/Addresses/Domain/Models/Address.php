<?php

namespace App\Addresses\Domain\Models;

use App\Countries\Domain\Models\Country;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'address_1',
        'city',
        'postal_code',
        'default'
    ];
    protected $casts = ['default' => 'boolean'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->hasOne(Country::class , 'id','country_id');
    }
}
