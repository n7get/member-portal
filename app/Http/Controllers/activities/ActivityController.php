<?php

namespace App\Http\Controllers\activities;

use App\Http\Controllers\Controller;
use App\Http\Requests\activities\ActivityRequest;
use App\Models\activities\Activity;
use App\Models\activities\ActivityLog;
use App\Models\activities\ActivityMode;
use App\Models\activities\ActivityType;
use App\Models\members\Member;
use App\Providers\activities\ActivityProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ActivityController extends Controller
{
  public function __construct(protected ActivityProvider $activityProvider)
  {}

  public function index(): View
  {
    $activities = Activity::all()->sortByDesc('date');

    return view('activities.index', compact('activities'));
  }

  public function create(): View
  {
    $activity = new Activity();
    $activity_types = ActivityType::all();
    return view('activities.create', compact(['activity', 'activity_types']));
  }

  public function store(ActivityRequest $request): RedirectResponse {
    $this->activityProvider->persist($request, new Activity());

    return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
  }

  public function show(int $id): View
  {
    $rawInput = '';
    if(env('PREFILL_FORMS', false)) {
      $rawInput = <<<EOT
3164  B  31    ARES   AA7I   09/25/23 19:59:46  Check in AA7I on 9/25/2023
3162  B  65    ARES   K7AAA  09/25/23 10:47:37  AL7LS 25 SEP 2023 Net Checkin
3161  B  22    ARES   N7AAA  09/25/23 10:40:37  Check in for 09/25/23
3160  B  31    ARES   K7KSG  09/25/23 10:04:40  K7KSG 25SEP23 VIA ANGEL POTOSI
3158  B  18    ARES   KI7MKQ 09/24/23 21:50:07  25 sep check in
EOT;
    }
    $activity = Activity::with(['logs.member', 'logs.mode'])->findOrFail($id);
    $logs = $activity->logs->map(function($log) {
      return [
        'id' => $log->id,
        'member' => $log->member->callsign,
        'attended' => $log->attended,
        'mode' => $log->mode?->description,
        'duration' => $log->duration,
        'notes' => $log->notes,
      ];
    });

    $members = Member::all()->sortBy('callsign')->pluck('callsign');
    $modes = ActivityMode::all()->sortBy('description')->pluck('description');

    return view('activities.show', compact('activity', 'modes', 'logs', 'members', 'rawInput'));
  }

  public function edit(Activity $activity): View
  {
    $activity_types = ActivityType::all();
    return view('activities.edit', compact(['activity', 'activity_types']));
  }

  public function update(ActivityRequest $request, Activity $activity): RedirectResponse
  {
    $this->activityProvider->persist($request, $activity);

    return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
  }

  public function destroy(Activity $activity): RedirectResponse
  {
    $activity->delete();

    return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
  }

  public function save(Request $request, Activity $activity): RedirectResponse
  {
    // Update Activity

    $this->activityProvider->persist($request, $activity);

    // Update ActivityLogs

    $formInputs = $request->input('log', []);
    $oldIds = ActivityLog::where('activity_id', $activity->id)->select('id')->get()->pluck('id')->toArray();

    foreach ($formInputs as $formInput) {
      if ($formInput['id']) {
        $log = ActivityLog::find($formInput['id']);
      } else {
        $log = new ActivityLog();
      }

      $log->activity_id = $activity->id;

      $member = Member::where('callsign', $formInput['member'])->first();
      $log->member_id = $member->id;

      if ($formInput['mode']) {
        $mode = ActivityMode::where('description', $formInput['mode'])->first();
        $log->activity_mode_id = $mode->id;
      } else {
        $log->activity_mode_id = null;
      }
      
      $log->attended = $formInput['attended'];
      $log->duration = $formInput['duration'];
      $log->notes = $formInput['notes'];

      if ($log->id) {
        $log->update();
      } else {
        $log->save();
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $formInputs);
    $deletedIds = array_diff($oldIds, $ids);
    ActivityLog::whereIn('id', $deletedIds)->delete();

    return redirect()->route('activities.show', $activity->id)->with('success', 'Activity saved successfully.');
  }

  public function attending(int $id): View
  {
    $activity = $this->activityProvider->loadActivityForMember(Auth::user()->member->id, $id);

    return view('activities.attending', compact('activity'));
  }

  public function updateAttending(int $id): RedirectResponse
  {
    $member_id = Auth::user()->member->id;

    $activity = $this->activityProvider->loadActivityForMember($member_id, $id);

    if ($activity->logs->count() == 0) {
      // create a new activity log

      $log = new ActivityLog(['member_id' => $member_id]);
      
      $activity->logs()->save($log);
    } else {
      $log = $activity->logs->first();

      $log->delete();
    } 

    $activity->update();

    return redirect()->route('activities.attending', $id)->with('success', 'Activity updated successfully.');
  }

  public function logs(int $id): View
  {
    $memberId = Auth::user()->member->id;

    $activity = Activity::where('id', $id)->with([
        'logs' => function ($query) use ($memberId) {
          $query->where('member_id', $memberId)
            ->where('attended', false);
        }
      ])
      ->firstOrFail();

    $logs = $activity->logs->map(function ($log) {
      return [
        'id' => $log->id,
        'mode' => $log->mode?->description,
        'duration' => $log->duration,
        'notes' => $log->notes,
      ];
    });

    $modes = ActivityMode::all()->sortBy('description')->pluck('description');

    return view('activities.logs', compact('activity', 'modes', 'logs'));
  }

  public function updateLogs(Request $request, int $id) {
    $formInputs = $request->input('log', []);

    foreach ($formInputs as $formInput) {
      $log = ActivityLog::find($formInput['id']);

      if ($formInput['mode']) {
        $mode = ActivityMode::where('description', $formInput['mode'])->first();
        $log->activity_mode_id = $mode->id;
      } else {
        $log->activity_mode_id = null;
      }

      $log->attended = 1;
      $log->duration = $formInput['duration'];
      $log->notes = $formInput['notes'];

      $log->update();

      return redirect()->route('dashboard')->with('success', 'Activity log saved successfully.');
    }
  }
}
