<?php

namespace App\Models\activities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMode extends Model
{
  use HasFactory;

  protected $fillable = [
    'description',
    'order',
  ];

  public function logs()
  {
    return $this->hasMany(ActivityLog::class);
  }
}
