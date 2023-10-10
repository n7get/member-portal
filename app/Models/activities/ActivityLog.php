<?php

namespace App\Models\activities;

use App\Casts\DurationCast;
use App\Models\members\Member;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\activities\ActivityLog
 * 
 * For future Activities, the presence of an activity_log for a given member
 * indicates that the member is attending the activity.
 * For past Activities, the activity_log.attended field indicates whether the
 * member attended the activity.
 */
class ActivityLog extends Pivot
{
  protected $table = 'activity_logs';

  protected $fillable = [
    'activity_id',
    'member_id',
    'activity_mode_id',
    'attended',
    'duration',
    'notes',
  ];

  protected $casts = [
    'duration' => DurationCast::class,
  ];

  public $timestamps = true;

  public function activity()
  {
    return $this->belongsTo(Activity::class);
  }

  public function member()
  {
    return $this->belongsTo(Member::class);
  }

  public function mode()
  {
    return $this->belongsTo(ActivityMode::class, 'activity_mode_id');
  }
}
