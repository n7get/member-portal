<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created resource in storage.
    public function store(UserRequest $request)
    {
        User::create($request->all());
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    // Display the specified resource.
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified resource.
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'admin' => $user->hasRole('Admin'),
            'leadership' => $user->hasRole('Leadership'),
            'member' => $user->hasRole('Member'),
        ]);

        // return view('users.edit', compact('user'));
    }

    // Update the specified resource in storage.
    public function update(UserRequest $request, User $user)
    {
        $data = $request->only(['name', 'email', 'email_verified_at', 'remember_token']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->forceFill($data)->update();

        
        if ($request->admin) {
            $user->assignRole('Admin');
        } else {
            $user->removeRole('Admin');
        }
        if ($request->leadership) {
            $user->assignRole('Leadership');
        } else {
            $user->removeRole('Leadership');
        }
        if ($request->member) {
            $user->assignRole('Member');
        } else {
            $user->removeRole('Member');
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
