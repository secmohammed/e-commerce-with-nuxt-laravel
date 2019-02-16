<?php

namespace App\App\Domain\Cart\Payments\Gateways;

use App\App\Domain\Cart\Payments\Gateway;
use App\Users\Domain\Models\User;
use Stripe\Customer as StripeCustomer;
class StripeGateway implements Gateway
{
    protected $user; 
 
    public function withUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function user()
    {
        return $this->user;
    }

    public function getCustomer()
    {
        return new StripeGatewayCustomer(
            $this,
            StripeCustomer::retrieve($this->user->gateway_customer_id)
        );
    }
    public function createCustomer()
    {
        if ($this->user->gateway_customer_id) {
            return $this->getCustomer();
        }

        $customer = new StripeGatewayCustomer(
            $this,
            $this->createStripeCustomer()
        );

        $this->user->update([
            'gateway_customer_id' => $customer->id()
        ]);

        return $customer;
    }
    protected function createStripeCustomer()
    {
        return StripeCustomer::create([
            'email' => $this->user->email
        ]);
    }
}
