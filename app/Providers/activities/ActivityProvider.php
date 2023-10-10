<?php

namespace App\Providers\activities;

use App\Models\activities\Activity;
use App\Models\activities\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ActivityProvider extends ServiceProvider
{
  public function __construct()
  {
  }

  /**
   * Load all future activities and mark the ones that the member is attending.
   * 
   * @param int $memberId The member id
   * @return Collection Activities
   */
  public function loadFutureActivities(int $memberId): Collection
  {
    // Get all activities that are in the future and left join the activity_logs
    // table to see if the current user is attending the activity.  An activity_log
    // is created when a member indicates they plan to attend an activity.  So if the
    // activity_log_id is null, the member is not attending the activity.  

    $activities = DB::table('activities')
      ->where('activities.date', '>=', date('Y-m-d'))
      ->leftJoin('activity_logs', function ($join) use ($memberId) {
        $join->on('activities.id', '=', 'activity_logs.activity_id')
          ->where('activity_logs.member_id', '=', $memberId);
      })
      ->select('activities.*', 'activity_logs.id as activity_logs_id')
      ->get();

    // Make a boolean 'attending' field based on the presence of an activity log
    // for the current user.  

    $activities->each(function ($activity) {
      $activity->attending = $activity->activity_logs_id !== null ? 1 : 0;
    });

    return $activities;
  }

  /**
   * Load all activity logs for the current user that are not marked as attended
   * 
   * @param int $memberId The member id
   * @return Collection Activities
   */
  public function loadUnloggedActivityLogs(int $memberId): Collection
  {
    // Get all activity logs for the current user that are not marked as attended

    $activityLogs = DB::table('activity_logs')
      ->where('activity_logs.member_id', '=', $memberId)
      ->where('activity_logs.attended', '=', 0)
      ->rightJoin('activities', function ($join) {
        $join->on('activity_logs.activity_id', '=', 'activities.id')
          ->where('activities.date', '<', date('Y-m-d'));
      })
      ->select(
        'activity_logs.id as activity_logs_id',
        'activities.description as activities_description',
        'activities.date as activities_date',
        'activities.duration as activities_duration',
        'activities.location as activities_location'
      )
      ->get();

    return $activityLogs;
  }

  public function loadActivittyLogs(int $memberId, array $activityIds)
  {
    $activityLogs = ActivityLog::whereHas('activity', function ($query) use ($activityIds) {
      $query->whereIn('id', $activityIds);
    })
      ->where('member_id', $memberId)
      ->get();
    return $activityLogs;
  }

  public function loadActivityForMember(int $memberId, int $activityId): Activity
  {
    $activity = Activity::where('id', $activityId)
      ->with(['logs' => function ($query) use ($memberId) {
        $query->where('member_id', $memberId);
      }])
      ->firstOrFail();

    return $activity;
  }

  public function persist(Request $request, Activity $activity): void
  {
    $activity->fill($request->all());

    if ($request->has('activity_type')) {
      $activity->activityType()->associate($request->input('activity_type', []));
    }

    if ($activity->id == null) {
      $activity->save();
    } else {
      $activity->update();
    }
  }
}
