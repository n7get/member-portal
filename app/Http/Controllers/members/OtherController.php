<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Models\members\Other;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OtherController extends Controller
{
  public function list(): View
  {
    $this->authorize('any', Other::class);

    $others = Other::orderby('order')->get();
    return view('others.list', compact('others'));
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('any', Other::class);
    
    $formInputs = $request->input('formInput', []);

    $oldIds = Other::select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $other = Other::find($formInput['id']);
      } else {
        $other = new Other();
      }

      $other->description = $formInput['description'];
      $other->needs_extra_info = $formInput['needs_extra_info'];
      $other->prompt = $formInput['prompt'];
      $other->order = $formInput['order'];

      if($other->id) {
        $other->update();
      } else {
        $other->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    Other::whereIn('id', $deletedIds)->delete();

    return redirect()->route('others.list')->with('success', 'Other skills & equipment saved successfully.');
  }
}
