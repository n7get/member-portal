<?php

namespace App\Models\activities;

use App\Casts\DurationCast;
use App\Models\members\Member;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
