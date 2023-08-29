<?php

namespace App\Providers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class UserProvider extends ServiceProvider
{
    public function __construct() {}

    public function populateModel(User $user) 
    {
        return [
            'user' => $user,
            'admin' => $user->hasRole('admin'),
            'leadership' => $user->hasRole('leadership'),
            'member' => $user->hasRole('member'),
        ];
    }

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

    public function setRoles(UserRequest $request, User $user): void
    {
        $roles = array_filter($request->only(['admin', 'leadership', 'member']), function($value) {
            return $value != 0;
        });

        $user->syncRoles(array_keys($roles));
    }
}
