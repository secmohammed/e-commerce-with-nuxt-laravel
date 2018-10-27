<?php

namespace Tests\Feature\Auth;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /** @test */
    public function it_validates_against_data()
    {
        $this->post('api/auth/register')->assertJsonValidationErrors(['name','password','email']);
    }
    /** @test */
    public function it_requires_a_valid_email()
    {
        $this->post('api/auth/register',[
            'email' => 'nope'
        ])->assertJsonValidationErrors(['email']);
    }
    /** @test */
    public function it_requires_a_valid_unique_email()
    {
        $user = factory(User::class)->create();
        $this->post('api/auth/register',[
            'email' => $user->email
        ])->assertJsonValidationErrors(['email']);
    }
    /** @test */
    public function it_registers_a_user()
    {
        $this->post('api/auth/register',[
            'name' => $name = 'ahmed',
            'email' => $email = 'ahmed@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertStatus(201);
        $this->assertDatabaseHas('users',compact('name','email'));
    }
    /** @test */
    public function it_returns_a_user_on_registration()
    {
        $this->post('api/auth/register',[
            'name' => $name = 'ahmed',
            'email' => $email = 'ahmed@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertStatus(201)->assertJsonFragment(compact('name','email'));
           
    }
}
