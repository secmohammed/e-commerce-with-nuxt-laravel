<?php

namespace Tests\Feature\PaymentMethods;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentMethodStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $this->post('api/payment-methods')->assertStatus(401);
    }
    /** @test */
    public function it_requires_a_token()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/payment-methods')->assertJsonValidationErrors(['token']);
    }
    /** @test */
    public function it_can_add_a_card()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ])->assertStatus(201);
        $this->assertDatabaseHas('payment_methods', [
            'user_id' => $user->id,
            'card_type' => 'Visa',
            'last_four' => '4242'
        ]);
    }
    /** @test */
    public function it_returns_the_created_card()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ])->assertJsonFragment([
            'card_type' => 'Visa'
        ]);
    }
    /** @test */
    public function it_sets_the_created_card_as_default()
    {
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ]);
        $this->assertDatabaseHas('payment_methods', [
            'id' => json_decode($response->getContent())->data->id,
            'default' => true
        ]);        
    }
}
