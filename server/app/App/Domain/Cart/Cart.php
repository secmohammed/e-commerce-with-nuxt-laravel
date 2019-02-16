<?php

namespace App\App\Domain\Cart;

use App\App\Domain\Cart\Money;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use App\Users\Domain\Models\User;

class Cart
{
    protected $user;
    protected $changed = false;
    protected $shipping;
    public function __construct(User $user = null){
        $this->user = $user;
    }
    public function withShipping($shippingId)
    {
        $this->shipping = ShippingMethod::find($shippingId);
        return $this;
    }
    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    }
    public function update($productId , $quantity)
    {
        $this->user->cart()->updateExistingPivot($productId , [
            'quantity' => $quantity
        ]);
    }
    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }
    public function empty()
    {
        $this->user->cart()->detach();
    }
    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') <= 0;
    }
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });
        return new Money($subtotal);
    }
    public function sync()
    {
        $this->user->load(['cart.stock']);
        $this->user->cart->each(function ($product) {
            $quantity = $product->minStock($product->pivot->quantity);
            if ($quantity != $product->pivot->quantity) {
                $this->changed = true;
            }
            $product->pivot->update([
                'quantity' => $quantity
            ]);
        });
    }
    public function hasChanged()
    {
        return $this->changed;
    }
    public function total()
    {
        if ($this->shipping) {
            return $this->subtotal()->add($this->shipping->price);
        }
        return $this->subtotal();
    }
    public function products()
    {
        return $this->user->cart;
    }
    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id',$productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
    protected function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function($product){
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })->toArray();
        
    }
}
