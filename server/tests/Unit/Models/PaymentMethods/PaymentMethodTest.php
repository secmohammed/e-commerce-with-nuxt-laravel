<?php

namespace Tests\Unit\Models\PaymentMethods;

use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $paymentMethod = factory(PaymentMethod::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $this->assertInstanceOf(User::class,$paymentMethod->user);
    }

    /** @test */
    public function it_sets_old_payment_method_to_not_default_while_creating()
    {
        $user = factory(User::class)->create();
        $oldPaymentMethod = factory(PaymentMethod::class)->create([
            'user_id' => $user->id,
            'default' => true 
        ]);
        factory(PaymentMethod::class)->create([
            'default' => true,
            'user_id' => $user->id
        ]);
        $this->assertFalse($oldPaymentMethod->fresh()->default);
    }
}
