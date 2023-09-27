<?php

namespace App\Models\activities;

use App\Casts\DateHourMinuteCast;
use App\Casts\DurationCast;
use App\Models\members\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  use HasFactory;

  protected $fillable = [
    'description',
    'date',
    'duration',
    'location',
    'notes',
  ];

  protected $casts = [
    'date' => DateHourMinuteCast::class,
    'duration' => DurationCast::class,
  ];

  public function activityType()
  {
    return $this->belongsTo(ActivityType::class);
  }

  public function logs()
  {
    return $this->hasMany(ActivityLog::class);
  }
}
