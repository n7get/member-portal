<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = 'resources_files';

    protected $fillable = [
      'name',
      'description',
      'access',
      'data',
    ];

    public function categories()
    {
      return $this->belongsToMany(Category::class, 'resources_categories_files');
    }
}
