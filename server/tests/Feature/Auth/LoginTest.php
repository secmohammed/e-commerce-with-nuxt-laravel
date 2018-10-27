<?php

namespace Tests\Feature\Auth;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function it_requires_email_and_password()
    {
        $this->post('api/auth/login')
        ->assertJsonValidationErrors(['email','password']);
    }
    /** @test */
    public function it_returns_an_unauthorized_error_if_credentials_dont_match()
    {
        $user = factory(User::class)->create();
        $this->post('api/auth/login',[
            'email' => $user->email,
            'password' => 'nope'
        ])->assertStatus(401);
    }
    /** @test */
    public function it_returns_a_token_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
        $this->post('api/auth/login',[
            'email' => $user->email,
            'password' => 'cats'
        ])->assertJsonStructure([
            'meta' => [
                'token'
            ]
        ]);
    }
    /** @test */
    public function it_returns_a_user_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
        $this->post('api/auth/login',[
            'email' => $user->email,
            'password' => 'cats'
        ])->assertJsonFragment([
            'email' => $user->email
        ]);
    }
}
