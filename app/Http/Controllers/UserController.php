<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User; 
use App\Providers\UserProvider;

class UserController extends Controller
{
    public function __construct(
        protected UserProvider $userProvider,   
    ) {}

    // Display a listing of the resource.
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $user = new User();

        return view('users.create', $this->userProvider->populateModel($user));
    }

    // Store a newly created resource in storage.
    public function store(UserRequest $request)
    {
        $user = new User();
    
        $this->userProvider->persist($request, $user);
    
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
        return view('users.edit', $this->userProvider->populateModel($user));
    }

    // Update the specified resource in storage.
    public function update(UserRequest $request, User $user)
    {
        $this->userProvider->persist($request, $user);

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
