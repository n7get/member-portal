<?php

namespace App\Models\resources;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
  public static $ACCESS_LEVELS = ['public', 'member', 'leadership'];

  protected $table = 'resources_files';

  protected $fillable = [
    'name',
    'file_name',
    'description',
    'version',
    'mime_type',
    'access',
    'data',
  ];

  public function categories()
  {
    return $this->belongsToMany(Category::class, 'resources_categories_files')->withPivot('order');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
