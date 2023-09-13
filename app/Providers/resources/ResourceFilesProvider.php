<?php

namespace App\Providers\resources;

use App\Models\resources\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class ResourceFilesProvider extends ServiceProvider
{
  public function __construct()
  {
  }

  public function getResources(string $access): Collection
  {
      $categories = Category::where('access', $access)->get()->sortBy('order');
      return $categories;
  }
}
