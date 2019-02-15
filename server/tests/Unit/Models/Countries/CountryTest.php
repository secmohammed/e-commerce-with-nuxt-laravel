<?php

namespace Tests\Unit\Models\Countries;

use App\Countries\Domain\Models\Country;
use App\ShippingMethods\Domain\Models\ShippingMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /** @test */
    public function it_has_many_shipping_methods()
    {
        $country = factory(Country::class)->create();
        $country->shippingMethods()->attach(
            factory(ShippingMethod::class)->create()
        );
        $this->assertInstanceOf(ShippingMethod::class, $country->shippingMethods->first());
    }
}
