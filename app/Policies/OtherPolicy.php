<?php

namespace App\Policies;

use App\Models\Other;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OtherPolicy
{
    public function any(User $user)
    {
        return $user->can('manage-members');
    }
}
