<?php

namespace App\Addresses\Domain\Observers;

use App\Addresses\Domain\Models\Address;

class AddressObserver
{
    public function creating(Address $address)
    {
        if ($address->default) {
            $address->user->addresses()->update([
                'default' => false
            ]);
        }
    }
}
