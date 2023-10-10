<?php

namespace App\Policies\members;

use App\Models\members\Other;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OtherPolicy
{
  public function any(User $user)
  {
    return $user->can('manage-members');
  }
}
