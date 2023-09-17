<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public static $ACCESS_LEVELS = ['member', 'leadership'];

  protected $table = 'resources_categories';

  protected $fillable = [
    'name',
    'description',
    'access',
  ];

  public function files()
  {
    return $this->belongsToMany(File::class, 'resources_categories_files')->withPivot('order')->orderBy('order');
  }
}
