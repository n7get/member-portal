<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\resources\FileRequest;
use App\Models\resources\File;
use App\Providers\resources\FileProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FileController extends Controller
{
  public function __construct(
    protected FileProvider $fileProvider,
  )
  {}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): View
  {
    $this->authorize('viewAny', File::class);

    $files = File::orderby('name')->get();
    return view('files.index', compact('files'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(): View
  {
    $this->authorize('create', File::class);

    $file = new File();
    $file->version = '1.0.0';
    $file->access = 'member';
    return view('files.create', [
      'file' => $file,
      'access_levels' => File::$ACCESS_LEVELS,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\resources\FileRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(FileRequest $request): RedirectResponse
  {
    $this->authorize('create', File::class);

    $file = new File();
    $file->user_id = $request->user()->id;

    $this->fileProvider->persist($request, $file);

    return redirect()->route('files.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\resources\File  $file
   * @return \Illuminate\Http\Response
   */
  public function show(File $file): View
  {
    $this->authorize('view', $file);

    return view('files.show', compact('file'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\resources\File  $file
   * @return \Illuminate\Http\Response
   */
  public function edit(File $file): View
  {
    $this->authorize('update', $file);

    return view('files.edit', [
      'file' => $file,
      'access_levels' => File::$ACCESS_LEVELS,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\resources\FileRequest  $request
   * @param  \App\Models\resources\File  $file
   * @return \Illuminate\Http\Response
   */
  public function update(FileRequest $request, File $file): RedirectResponse
  {
    $this->authorize('update', $file);

    $file->user_id = $request->user()->id;
    $this->fileProvider->persist($request, $file);

    return redirect()->route('files.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\resources\File  $file
   * @return \Illuminate\Http\Response
   */
  public function destroy(File $file): RedirectResponse
  {
    $this->authorize('delete', $file);
    
    $file->delete();
    return redirect()->route('files.index');
  }
}
