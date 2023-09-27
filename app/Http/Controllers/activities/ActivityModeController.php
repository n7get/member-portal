<?php

// ActivityModeController.php

namespace App\Http\Controllers\activities;

use App\Http\Controllers\Controller;
use App\Models\activities\ActivityMode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityModeController extends Controller
{
  public function list(): View
  {
    $this->authorize('any', ActivityMode::class);

    $activity_modes = ActivityMode::orderby('order')->get();
    return view('activities.modes', compact('activity_modes'));
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('any', ActivityMode::class);

    $formInputs = $request->input('formInput', []);

    $oldIds = ActivityMode::select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $ActivityMode = ActivityMode::find($formInput['id']);
      } else {
        $ActivityMode = new ActivityMode();
      }

      $ActivityMode->description = $formInput['description'];
      $ActivityMode->order = $formInput['order'];

      if ($ActivityMode->id) {
        $ActivityMode->update();
      } else {
        $ActivityMode->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    ActivityMode::whereIn('id', $deletedIds)->delete();

    return redirect()->route('activity_modes.list')->with('success', 'Activity Modes saved successfully.');
  }
}
