<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Models\members\Certification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificationController extends Controller
{
  public function list(): View
  {
    $this->authorize('any', Certification::class);

    $certifications = Certification::orderby('order')->get();
    return view('certifications.list', compact('certifications'));
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('any', Certification::class);

    $formInputs = $request->input('formInput', []);

    $oldIds = Certification::select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $certification = Certification::find($formInput['id']);
      } else {
        $certification = new Certification();
      }

      $certification->description = $formInput['description'];
      $certification->order = $formInput['order'];

      if ($certification->id) {
        $certification->update();
      } else {
        $certification->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    Certification::whereIn('id', $deletedIds)->delete();

    return redirect()->route('certifications.list')->with('success', 'Certifications saved successfully.');
  }
}
