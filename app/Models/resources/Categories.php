<?php

namespace App\Models\resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'resources_categories';

    protected $fillable = [
      'name',
      'description',
      'mime_type',
      'type',
      'order',
    ];

    public function files()
    {
      return $this->belongsToMany(Files::class, 'resources_categories_files');
    }
}
