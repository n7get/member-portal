<?php

// CapabilityController.php

namespace App\Http\Controllers;

use App\Models\Capability;
use App\Http\Requests\CapabilityRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CapabilityController extends Controller
{
    public function index()
    {
        $capabilities = Capability::all();
        return view('admin.capabilities.index', compact('capabilities'));
    }

    public function create()
    {
        $capability = new Capability();
        $capability->order = Capability::max('order') + 10;
        
        return view('admin.capabilities.create', compact('capability'));
    }

    public function store(CapabilityRequest $request)
    {
        Capability::create($request->validated());
        return redirect()->route('capabilities.index')->with('success', 'Capability added successfully.');
    }

    public function show(Capability $capability)
    {
        return view('admin.capabilities.show', compact('capability'));
    }

    public function edit(Capability $capability)
    {
        return view('admin.capabilities.edit', compact('capability'));
    }

    public function update(CapabilityRequest $request, Capability $capability)
    {
        $capability->update($request->validated());
        return redirect()->route('capabilities.index')->with('success', 'Capability updated successfully.');
    }

    public function destroy(Capability $capability)
    {
        $capability->delete();
        return redirect()->route('capabilities.index')->with('success', 'Capability deleted successfully.');
    }
}
