<?php

namespace Tests\Feature\Auth;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticatedUserTest extends TestCase
{
    /** @test */
    public function it_fails_if_user_isnt_authenticated()
    {
        $this->get('/api/user')->assertStatus(401);
    }
    /** @test */
    public function it_returns_user_details()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'GET','api/user')->assertJsonFragment(['email' => $user->email]);
    }
}
