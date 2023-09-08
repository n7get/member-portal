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
      'type',
      'data',
    ];

    public function categories()
    {
      return $this->belongsToMany(Categories::class, 'resources_categories_files');
    }
}
