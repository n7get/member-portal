<?php

namespace App\Policies\activities;

use App\Models\User;

class ActivityModePolicy
{
  public function any(User $user)
  {
    return $user->can('manage-activities');
  }
}
