<?php

namespace App\Orders\Domain\Models;

use App\Addresses\Domain\Models\Address;
use App\App\Domain\Cart\Money;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use App\Transactions\Domain\Models\Transaction;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const PAYMENT_FAILED = 'payment_failed';
    const COMPLETED = 'completed';
    
    protected $fillable = [
        'status',
        'address_id',
        'shipping_method_id',
        'payment_method_id',
        'subtotal'
    ];

    public function getSubtotalAttribute($subtotal)
    {
        return new Money($subtotal);
    }

    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->status = self::PENDING;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);   
    }
    
    public function products()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation_order')
            ->withPivot(['quantity'])
            ->withTimestamps();
    }
}
