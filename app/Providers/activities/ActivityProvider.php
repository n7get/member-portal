<?php

namespace App\Providers\activities;

use App\Models\activities\Activity;
use App\Models\activities\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ActivityProvider extends ServiceProvider
{
    public function __construct()
    {
    }

    /**
     * Load all future activities and mark the ones that the user is attending
     * @param int $memberId The member id
     * @return Collection Activities
     */
    public function loadFutureActivities(int $memberId): Collection
    {
        $activities = Activity::where('date', '>=', date('Y-m-d'))->get()->sortBy('date');

        // Add attending field for activities that the user is attending

        $activityIds = $activities->pluck('id')->toArray();
        $activityLogIds = $this->loadActivittyLogs($memberId, $activityIds)->pluck('activity_id')->toArray();
        $activities->each(function ($activity) use ($activityLogIds) {
            $activity->attending = in_array($activity->id, $activityLogIds);
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
        $activities = Activity::where('date', '<', date('Y-m-d'))
            ->whereHas('logs', function ($query) {
                $query->where('attended', false);
            })
            ->with(['logs' => function ($query) use ($memberId) {
                $query->where('member_id', $memberId);
            }])
            ->get();

        return $activities;
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
