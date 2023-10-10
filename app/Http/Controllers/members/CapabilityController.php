<?php

// CapabilityController.php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Models\members\Capability;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CapabilityController extends Controller
{
  public function list(): View
  {
    $this->authorize('any', Capability::class);

    $capabilities = Capability::orderby('order')->get();
    return view('capabilities.list', compact('capabilities'));
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('any', Capability::class);

    $formInputs = $request->input('formInput', []);

    $oldIds = Capability::select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $capability = Capability::find($formInput['id']);
      } else {
        $capability = new Capability();
      }

      $capability->description = $formInput['description'];
      $capability->order = $formInput['order'];

      if ($capability->id) {
        $capability->update();
      } else {
        $capability->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    Capability::whereIn('id', $deletedIds)->delete();

    return redirect()->route('capabilities.list')->with('success', 'Capabilities saved successfully.');
  }
}
