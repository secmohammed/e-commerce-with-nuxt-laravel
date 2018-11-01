<?php

namespace App\Countries\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'code' ,'name'
    ];
}
