<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Models\Certification;
use Illuminate\Routing\Controller;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::all();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        $certification = new Certification();
        $certification->order = Certification::max('order') + 10;
        
        return view('admin.certifications.create', compact('certification'));
    }

    public function store(CertificationRequest $request)
    {
        Certification::create($request->validated());
        return redirect()->route('certifications.index')->with('success', 'Certification added successfully.');
    }

    public function show(Certification $certification)
    {
        return view('admin.certifications.show', compact('certification'));
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(CertificationRequest $request, Certification $certification)
    {
        $certification->update($request->validated());
        return redirect()->route('certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
        return redirect()->route('certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
