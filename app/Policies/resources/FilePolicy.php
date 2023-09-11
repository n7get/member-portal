<?php

namespace App\Policies\resources;

use App\Models\User;

class FilePolicy
{
  public function viewAny(User $user)
  {
    return $user->can('manage-resources');
  }

  public function view(User $user)
  {
    return $user->can('manage-resources');
  }

  public function create(User $user)
  {
    return $user->can('manage-resources');
  }

  public function update(User $user)
  {
    return $user->can('manage-resources');
  }

  public function delete(User $user)
  {
    return $user->can('manage-resources');
  }
}
