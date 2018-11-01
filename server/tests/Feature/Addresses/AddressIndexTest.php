<?php

namespace Tests\Feature\Addresses;

use App\Addresses\Domain\Models\Address;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
       $this->get('/api/addresses')->assertStatus(401);
    }
    /** @test */
    public function it_shows_addresses()
    {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);
        $this->jsonAs($user,'GET','/api/addresses')->assertJsonFragment([
            'id' => $address->id
        ]);
    }
}
