<?php

namespace Tests\Feature\Addresses;

use App\Addresses\Domain\Models\Address;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentMethodIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $this->get('api/payment-methods')->assertStatus(401);
    }
    /** @test */
    public function it_requires_a_collection_of_payment_methods()
    {
        $user = factory(User::class)->create();
        $payment = factory(PaymentMethod::class)->create([
            'user_id' => $user->id
        ]);
        $this->jsonAs($user, 'GET', 'api/payment-methods')->assertJsonFragment([
            'id' => $payment->id
        ]);
    }
}
