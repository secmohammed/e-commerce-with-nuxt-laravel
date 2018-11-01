<?php

namespace App\Users\Domain\Observers;

use App\Users\Domain\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
    }
    public function updating(User $user)
    {
        $user->password = bcrypt($user->password);
    }
}
