<?php

namespace App\Providers\resources;

use App\Http\Requests\resources\FileRequest;
use App\Models\resources\File;
use Illuminate\Support\ServiceProvider;

class FileProvider extends ServiceProvider
{
  public function __construct()
  {
  }

  public function persist(FileRequest $request, File $file): void
  {
    $file->fill($request->all());

    if ($request->has('data')) {
      $file->file_name = $request->file('data')->getClientOriginalName();
      $file->mime_type = $request->file('data')->getMimeType();
      $file->data = $request->file('data')->get();
    }

    if ($file->id == null) {
      $file->save();
    } else {
      $file->update();
    }
  }
}
