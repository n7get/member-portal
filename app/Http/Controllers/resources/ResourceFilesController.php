<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Models\resources\Category;
use App\Models\resources\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceFilesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category): View
    {
        $this->authorize('update', $category);

        $file = new File();

        $order = $category->files()->max('order');
        if (!$order) {
            $order = 0;
        }
        $order += 10;

        $files = File::orderby('name')->get();

        return view('categories.files.create', [
            'category' => $category,
            'file' => $file,
            'files' => $files,
            'order' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $file = File::find($request->file_id);

        $category->files()->attach($file->id, ['order' => $request->order]);

        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, File $file): View
    {
        $this->authorize('update', $category);

        // file the file in the category in the pivot table
        $file = $category->files()->where('file_id', $file->id)->first();
        
        $files = File::orderby('name')->get();

        return view('categories.files.edit', [
            'category' => $category,
            'file' => $file,
            'files' => $files,
            'order' => $file->pivot->order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, File $file): RedirectResponse
    {
        $this->authorize('update', $category);

        $category->files()->updateExistingPivot($file->id, ['order' => request('order')]);
        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, File $file): RedirectResponse
    {
        $this->authorize('update', $category);

        $category->files()->detach($file->id);
        return redirect()->route('categories.show', $category->id);
    }
}
