<?php

// CapabilityController.php

namespace App\Http\Controllers;

use App\Models\Capability;
use App\Http\Requests\CapabilityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CapabilityController extends Controller
{
    public function index(): View
    {
        $this->authorize('any', Capability::class);

        $capabilities = Capability::orderby('order')->get();
        return view('capabilities.index', compact('capabilities'));
    }

    public function create(): View
    {
        $this->authorize('any', Capability::class);

        $capability = new Capability();
        $capability->order = Capability::max('order') + 10;
        
        return view('capabilities.create', compact('capability'));
    }

    public function store(CapabilityRequest $request): RedirectResponse
    {
        $this->authorize('any', Capability::class);

        Capability::create($request->validated());
        return redirect()->route('capabilities.index')->with('success', 'Capability added successfully.');
    }

    public function show(Capability $capability): View
    {
        $this->authorize('any', Capability::class);

        return view('capabilities.show', compact('capability'));
    }

    public function edit(Capability $capability): View
    {
        $this->authorize('any', Capability::class);

        return view('capabilities.edit', compact('capability'));
    }

    public function update(CapabilityRequest $request, Capability $capability): RedirectResponse
    {
        $this->authorize('any', Capability::class);

        $capability->update($request->validated());
        return redirect()->route('capabilities.index')->with('success', 'Capability updated successfully.');
    }

    public function destroy(Capability $capability): RedirectResponse
    {
        $this->authorize('any', Capability::class);

        $capability->delete();
        return redirect()->route('capabilities.index')->with('success', 'Capability deleted successfully.');
    }
}
