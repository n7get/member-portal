<?php

namespace App\Models\members;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
  protected $table = 'member_others';

  protected $fillable = [
    'description',
    'needs_extra_info',
    'prompt',
  ];

  public function members()
  {
    return $this->belongsToMany(Member::class, 'members_member_others');
  }

  public $timestamps = false; // Indicates that the table doesn't have created_at and updated_at timestamps
}
