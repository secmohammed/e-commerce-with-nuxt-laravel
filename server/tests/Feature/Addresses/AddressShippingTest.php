<?php

namespace Tests\Feature\Addresses;

use App\Addresses\Domain\Models\Address;
use App\Countries\Domain\Models\Country;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressShippingTest extends TestCase
{
    /** @test */
    public function it_fails_if_the_user_is_not_authenticated()
    {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);
        $this->get("api/addresses/$address->id/shipping")->assertStatus(401);
    }
    /** @test */
    public function it_fails_if_the_address_cant_be_found()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'GET', 'api/addresses/1/shipping')->assertStatus(404);        
    }
    /** @test */
    public function it_fails_if_the_user_doesnt_own_the_address()
    {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create();
        $this->jsonAs($user, 'GET', "api/addresses/$address->id/shipping")->assertStatus(403);
    }
    /** @test */
    public function it_shows_shipping_methods_for_the_given_address()
    {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create([
            'user_id' => $user->id,
            'country_id' => ($country = factory(Country::class)->create())->id
        ]);
        $country->shippingMethods()->save(
            $shipping = factory(ShippingMethod::class)->create()
        );
        $this->jsonAs($user, 'GET', "api/addresses/$address->id/shipping")->assertStatus(200)->assertJsonFragment([
            'id' => $shipping->id
        ]);

    }
}
