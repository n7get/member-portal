<?php

namespace App\Policies\activities;

use App\Models\User;

class ActivityTypePolicy
{
  public function any(User $user)
  {
    return $user->can('manage-activities');
  }
}
