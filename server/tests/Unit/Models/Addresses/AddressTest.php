<?php

namespace Tests\Unit\Models\Addresses;

use App\Addresses\Domain\Models\Address;
use App\Countries\Domain\Models\Country;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /** @test */
    public function it_has_one_country()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $this->assertInstanceOf(Country::class,$address->country);
    }
    /** @test */
    public function it_belongs_to_a_user()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $this->assertInstanceOf(User::class,$address->user);
    }
    /** @test */
    public function it_sets_old_addresses_to_not_default_while_creating()
    {
        $user = factory(User::class)->create();
        $oldAddress = factory(Address::class)->create([
            'user_id' => $user->id,
            'default' => true 
        ]);
        factory(Address::class)->create([
            'default' => true,
            'user_id' => $user->id
        ]);
        $this->assertFalse($oldAddress->fresh()->default);
    }
}
