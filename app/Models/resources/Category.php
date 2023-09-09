<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public static $ACCESS_LEVELS = ['public', 'member', 'leadership'];

  protected $table = 'resources_categories';

  protected $fillable = [
    'name',
    'description',
    'access',
    'order',
  ];

  public function files()
  {
    return $this->belongsToMany(File::class, 'resources_categories_files');
  }
}
