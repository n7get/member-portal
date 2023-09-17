<?php

namespace Database\Seeders;

use App\Models\resources\Category;
use App\Models\resources\File;
use Illuminate\Database\Seeder;

class ResourcesCategoriesFilesSeeder extends Seeder
{
  public function run()
  {
    $categories = Category::all();
    $files = File::all();

    foreach ($categories as $key => $category) {
      $selectFiles = $files->random(rand(1, $files->count()));
      foreach($selectFiles as $f) {
        $category->files()->attach($f->id, [
          'order' => $key,
        ]);
      }
    }
  }
}
