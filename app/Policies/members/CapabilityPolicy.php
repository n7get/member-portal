<?php

namespace App\Policies\members;

use App\Models\members\Capability;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CapabilityPolicy
{
  public function any(User $user)
  {
    return $user->can('manage-members');
  }
}
