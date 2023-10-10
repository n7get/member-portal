<?php

// ActivityTypeController.php

namespace App\Http\Controllers\activities;

use App\Http\Controllers\Controller;
use App\Models\activities\ActivityType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityTypeController extends Controller
{
  public function list(): View
  {
    $this->authorize('any', ActivityType::class);

    $activity_types = ActivityType::orderby('order')->get();
    return view('activities.types', compact('activity_types'));
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('any', ActivityType::class);

    $formInputs = $request->input('formInput', []);

    $oldIds = ActivityType::select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $ActivityType = ActivityType::find($formInput['id']);
      } else {
        $ActivityType = new ActivityType();
      }

      $ActivityType->description = $formInput['description'];
      $ActivityType->order = $formInput['order'];

      if ($ActivityType->id) {
        $ActivityType->update();
      } else {
        $ActivityType->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    ActivityType::whereIn('id', $deletedIds)->delete();

    return redirect()->route('activity_types.list')->with('success', 'Activity types saved successfully.');
  }
}
