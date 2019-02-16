<?php

namespace App\App\Domain\Cart\Payments\Gateways;

use App\App\Domain\Cart\Payments\Gateway;
use App\App\Domain\Cart\Payments\GatewayCustomer;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\Users\Domain\Models\User;
use Stripe\Charge;
use Stripe\Customer;
class StripeGatewayCustomer implements GatewayCustomer
{
    private $gateway;
    private $customer;

    public function __construct(Gateway $gateway, Customer $customer)
    {
        $this->gateway = $gateway;
        $this->customer = $customer;
    }


    public function charge(PaymentMethod $card, $amount)
    {
        try {

            Charge::create([
                'currency' => 'gbp',
                'amount' => $amount,
                'customer' => $this->customer->id,
                'source' => $card->provider_id
            ]);   
                
        } catch (\Exception $e) {
            throw new \App\PaymentMethods\Domain\Exceptions\PaymentFailedException;
        }
    }

    public function addCard($data)
    {
        $card = $this->customer->sources->create([
            'source' => $data['token'],
        ]);
        
        $this->customer->default_source = $card->id;
        $this->customer->save();

        return $this->gateway->user()->paymentMethods()->create([
            'provider_id' => $card->id,
            'card_type' => $card->brand,
            'last_four' => $card->last4,
            'default' => true
        ]);
    }
    public function id()
    {
        return $this->customer->id;
    }
}
