<?php

namespace App\Providers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class UserProvider extends ServiceProvider
{
    public function __construct() {}

    /**
     * Populate the model with the given attributes.
     */
    public function populateModel(User $user): array
    {
        return [
            'user' => $user,
            'admin' => $user->hasRole('admin'),
            'leadership' => $user->hasRole('leadership'),
            'member' => $user->hasRole('member'),
        ];
    }

    /**
     * Persist the given request.
     */
    public function persist(UserRequest $request, User $user): void
    {
        $data = $request->only(['name', 'email', 'email_verified_at', 'remember_token']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if($user->id == null) {
            $user->create($data);
        } else {
            $user->update($data);
        }
        
        $this->setRoles($request, $user);
    }

    /**
     * Set the roles for the given request.
     */
    public function setRoles(UserRequest $request, User $user): void
    {
        $roles = array_filter($request->only(['admin', 'leadership', 'member']), function($value) {
            return $value != 0;
        });

        $user->syncRoles(array_keys($roles));
    }
}
