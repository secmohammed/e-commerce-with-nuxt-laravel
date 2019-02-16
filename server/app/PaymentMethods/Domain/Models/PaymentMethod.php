<?php

namespace App\PaymentMethods\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'card_type',
        'last_four',
        'provider_id',
        'default'
    ];
    protected $casts = ['default' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
