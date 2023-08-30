<?php

namespace App\Policies;

use App\Models\Capability;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CapabilityPolicy
{
    public function any(User $user)
    {
        return $user->can('manage-members');
    }
}
