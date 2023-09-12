<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectToPrevious;
use App\Http\Requests\resources\CategoryRequest;
use App\Models\resources\Category;
use App\Models\resources\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
  public function index(): View
  {
    $this->authorize('viewAny', Category::class);

    $categories = Category::orderby('order')->get();
    return view('categories.index', compact('categories'));
  }

  public function create(): View
  {
    $this->authorize('create', Category::class);

    $category = new Category();
    $category->order = Category::max('order') + 10;

    return view('categories.create', [
      'category' => $category,
      'access_levels' => Category::$ACCESS_LEVELS,
    ]);
  }

  public function store(CategoryRequest $request): RedirectResponse
  {
    $this->authorize('create', Category::class);

    Category::create($request->validated());
    return redirect()->route('categories.index');
  }

  public function show(Category $category): View
  {
    $this->authorize('view', $category);

    return view('categories.show', compact('category'));
  }

  public function edit(Category $category): View
  {
    $this->authorize('update', $category);

    return view('categories.edit', [
      'category' => $category,
      'access_levels' => Category::$ACCESS_LEVELS,
    ]);
  }

  public function update(CategoryRequest $request, Category $category): RedirectResponse
  {
    $this->authorize('update', $category);

    $category->update($request->validated());
    return redirect()->route('categories.index');
  }

  public function destroy(Category $category): RedirectResponse
  {
    $this->authorize('delete', $category);

    $category->delete();
    return redirect()->route('categories.index');
  }
}
