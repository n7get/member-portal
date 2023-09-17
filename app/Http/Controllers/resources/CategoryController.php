<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Models\resources\Category;
use App\Models\resources\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class CategoryController extends Controller
{
  public function list(string $access): View
  {
    $this->authorize('viewAny', Category::class);

    $categories = Category::where('access', $access)->orderby('order')->with('files')->orderby('order')->get();
    $access_levels = collect(Category::$ACCESS_LEVELS);
    $all_files = File::where('access', $access)->orderby('name')->get();

    return view('categories.list', [
      'access' => $access,
      'access_levels' => $access_levels,
      'all_files' => $all_files,
      'categories' => $categories,
    ]);
  }

  public function save(Request $request): RedirectResponse
  {
    $this->authorize('update', Category::class);

    $access = $request->input('access');
    $categories = $request->input('category', []);
    $files = $request->input('file', []);

    $oldIds = Category::where('access', $access)->select('id')->get()->pluck('id')->toArray();

    // Update existing or create new

    foreach ($categories as $category_index => $c) {
      if ($c['id']) {
        $category = Category::find($c['id']);
      } else {
        $category = new Category();
      }

      $category->name = $c['name'];
      $category->description = $c['description'];
      $category->access = $access;
      $category->order = $category_index;

      if ($category->id) {
        $category->update();
      } else {
        $category->save();
      }

      // Update files

      if (isset($files[$category_index])) {
        $category->files()->sync($files[$category_index]);
      } else {
        $category->files()->sync([]);
      }
    }

    // Delete removed

    $ids = array_map(fn($value) => $value['id'], $categories);
    $deletedIds = array_diff($oldIds, $ids);
    Category::whereIn('id', $deletedIds)->delete();

    return redirect()->route('categories.list', $access)->with('success', ucfirst($access) . ' resources saved successfully.');
  }
}
