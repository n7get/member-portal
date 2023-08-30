<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

// class UserPolicy extends \Spatie\Permission\Models\Permission
class UserPolicy
{
    public function index(User $user)
    {
        return $user->can('manage-users');
    }

    public function create(User $user)
    {
        return $user->can('manage-users');
    }

    public function store(User $user)
    {
        return $user->can('manage-users');
    }

    public function edit(User $user, User $model)
    {
        if ($user->can('manage-users')) {
            return true;
        }
        return $user->id === $model->id;
    }

    public function update(User $user, User $model)
    {
        if ($user->can('manage-users')) {
            return true;
        }
        return $user->id === $model->id;
    }

    public function destroy(User $user, User $model)
    {
        if ($user->can('manage-users')) {
            return true;
        }
        return $user->id === $model->id;
    }
}
