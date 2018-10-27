<?php

namespace App\Users\Domain\Observers;

use App\Users\Domain\Models\User;
use Hash;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = Hash::make($user->password);
    }
}
