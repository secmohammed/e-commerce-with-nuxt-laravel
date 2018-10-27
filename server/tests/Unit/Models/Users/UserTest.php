<?php

namespace Tests\Unit\Models\Users;

use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_the_password_when_creating()
    {
        $user = factory(User::class)->create([
            'password' => 'cats'
        ]);
       $this->assertNotEquals($user->password , 'cats');
    }
}
