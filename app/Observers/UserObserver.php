<?php

namespace App\Observers;

use App\Events\UserRegistered;
use App\Models\User;

class UserObserver
{
    public function saving(User $user) {
        event(new UserRegistered($user));
    }
}
