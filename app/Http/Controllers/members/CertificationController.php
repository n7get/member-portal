<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Http\Requests\members\CertificationRequest;
use App\Models\members\Certification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index(): View
    {
        $this->authorize('any', Certification::class);

        $certifications = Certification::orderby('order')->get();
        return view('certifications.index', compact('certifications'));
    }

    public function create(): View
    {
        $this->authorize('any', Certification::class);

        $certification = new Certification();
        $certification->order = Certification::max('order') + 10;
        
        return view('certifications.create', compact('certification'));
    }

    public function store(CertificationRequest $request): RedirectResponse
    {
        $this->authorize('any', Certification::class);

        Certification::create($request->validated());
        return redirect()->route('certifications.index')->with('success', 'Certification added successfully.');
    }

    public function show(Certification $certification): View
    {
        $this->authorize('any', Certification::class);

        return view('certifications.show', compact('certification'));
    }

    public function edit(Certification $certification): View
    {
        $this->authorize('any', Certification::class);

        return view('certifications.edit', compact('certification'));
    }

    public function update(CertificationRequest $request, Certification $certification): RedirectResponse
    {
        $this->authorize('any', Certification::class);

        $certification->update($request->validated());
        return redirect()->route('certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification): RedirectResponse
    {
        $this->authorize('any', Certification::class);

        $certification->delete();
        return redirect()->route('certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
