<?php

namespace Tests\Feature\Addresses;

use App\Addresses\Domain\Models\Address;
use App\Countries\Domain\Models\Country;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_not_authenticated()
    {
        $this->post('api/addresses')->assertStatus(401);
    }
    /** @test */
    public function it_requires_a_name()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses')->assertJsonValidationErrors(['name']);   
    }
    /** @test */
    public function it_requires_an_address()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses')->assertJsonValidationErrors(['address_1']);   
    }
    /** @test */
    public function it_requires_a_city()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses')->assertJsonValidationErrors(['city']);   
    }
    /** @test */
    public function it_requires_a_postal_code()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses')->assertJsonValidationErrors(['postal_code']);   
    }
    /** @test */
    public function it_requires_a_country()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses')->assertJsonValidationErrors(['country_id']);   
    }
    /** @test */
    public function it_requires_an_existing_country()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','api/addresses', [
            'country_id' => 1
        ])->assertJsonValidationErrors(['country_id']);   
    }
    /** @test */
    public function it_stores_an_address()
    {
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user , 'POST','/api/addresses', $payload = [
            'name' => 'Mohammed',
            'address_1' => '123 code street',
            'postal_code' => 'C0123',
            'country_id' => factory(Country::class)->create()->id,
            'city' => 'London'
        ]);
        $this->assertDatabaseHas('addresses',array_merge($payload,[
            'user_id' => $user->id
        ]));
    }
    /** @test */
    public function it_returns_an_address_when_created()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user , 'POST','/api/addresses', $payload = [
            'name' => 'Mohammed',
            'address_1' => '123 code street',
            'postal_code' => 'C0123',
            'country_id' => factory(Country::class)->create()->id,
            'city' => 'London'
        ])->assertJsonFragment([
            'name' => $payload['name']
        ]);
    }

}
