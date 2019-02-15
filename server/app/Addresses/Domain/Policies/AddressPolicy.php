<?php

namespace App\Addresses\Domain\Policies;

use App\Addresses\Domain\Models\Address;
use App\Users\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Address $address)
    {
        return $user->id == $address->user_id;
    }
}
