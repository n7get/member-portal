<?php

namespace App\Policies;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CertificationPolicy
{
    public function any(User $user)
    {
        return $user->can('manage-members');
    }
}
