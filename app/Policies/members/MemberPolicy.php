<?php

namespace App\Policies\members;

use App\Models\members\Member;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('manage-members');
    }

    public function show(User $user, Member $model)
    {
        if ($user->can('manage-members')) {
            return true;
        }
        return $user->id === $model->user_id;
    }

    public function edit(User $user, Member $model)
    {
        if ($user->can('manage-members')) {
            return true;
        }
        return $user->id === $model->user_id;
    }

    public function update(User $user, Member $model)
    {
        if ($user->can('manage-members')) {
            return true;
        }
        return $user->id === $model->user_id;
    }

    public function destroy(User $user, Member $model)
    {
        if ($user->can('manage-members')) {
            return true;
        }
        return $user->id === $model->user_id;
    }
}
