<?php

namespace App\App\Domain\Cart\Payments;

use App\Users\Domain\Models\User;
interface Gateway
{
    public function withUser(User $user);

    public function createCustomer();

}
