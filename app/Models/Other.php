<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Other extends Model
{
  protected $table = 'others';

  protected $fillable = [
    'description',
    'needs_extra_info',
    'prompt',
    'order',
  ];

  public function members()
  {
    return $this->belongsToMany(Member::class);
  }

  public $timestamps = false; // Indicates that the table doesn't have created_at and updated_at timestamps
}