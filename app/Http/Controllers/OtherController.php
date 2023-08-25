<?php

namespace App\Http\Controllers;

use App\Models\Other;
use App\Http\Requests\OtherRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OtherController extends Controller
{
  public function index()
  {
    $others = Other::all();
    return view('admin.others.index', compact('others'));
  }

  public function create()
  {
    $other = new Other();
    $other->order = Other::max('order') + 10;

    return view('admin.others.create', compact('other'));
  }

  public function store(OtherRequest $request)
  {
    Other::create($request->validated());
    return redirect()->route('others.index')->with('success', 'Other item created successfully.');
  }

  public function show(Other $other)
  {
    return view('admin.others.show', compact('other'));
  }

  public function edit(Other $other)
  {
    return view('admin.others.edit', compact('other'));
  }

  public function update(OtherRequest $request, Other $other)
  {
    $other->update($request->validated());
    return redirect()->route('others.index')->with('success', 'Other item updated successfully.');
  }

  public function destroy(Other $other)
  {
    $other->delete();
    return redirect()->route('others.index')->with('success', 'Other item deleted successfully.');
  }
}
