<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Models\members\Other;
use App\Http\Requests\members\OtherRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OtherController extends Controller
{
  public function index(): View
  {
    $this->authorize('any', Other::class);

    $others = Other::orderby('order')->get();
    return view('others.index', compact('others'));
  }

  public function create(): View
  {
    $this->authorize('any', Other::class);

    $other = new Other();
    $other->order = Other::max('order') + 10;

    return view('others.create', compact('other'));
  }

  public function store(OtherRequest $request): RedirectResponse
  {
    $this->authorize('any', Other::class);

    Other::create($request->validated());
    return redirect()->route('others.index')->with('success', 'Other item created successfully.');
  }

  public function show(Other $other): View
  {
    $this->authorize('any', Other::class);

    return view('others.show', compact('other'));
  }

  public function edit(Other $other): View
  {
    $this->authorize('any', Other::class);

    return view('others.edit', compact('other'));
  }

  public function update(OtherRequest $request, Other $other): RedirectResponse
  {
    $this->authorize('any', Other::class);

    $other->update($request->validated());
    return redirect()->route('others.index')->with('success', 'Other item updated successfully.');
  }

  public function destroy(Other $other): RedirectResponse
  {
    $this->authorize('any', Other::class);
    
    $other->delete();
    return redirect()->route('others.index')->with('success', 'Other item deleted successfully.');
  }
}