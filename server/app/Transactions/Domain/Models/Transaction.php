<?php

namespace App\Transactions\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'total'
    ];
}
