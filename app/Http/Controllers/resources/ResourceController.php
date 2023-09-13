<?php

namespace App\Http\Controllers\resources;

use App\Http\Controllers\Controller;
use App\Models\resources\File;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
  public function view(string $name)
  {
    $this->output($name, 'inline');
  }

  public function download(string $name) {
    $this->output($name, 'attachment', true);
  }
  
  private function output(string $name, string $disposition, bool $contentDescription = false) {
    $file = File::where('name', $name)->firstOrFail();

    if (! $file->access == 'public' && ! Auth::user()->hasRole($file->access)) {
      abort(403);
    }

    if ($contentDescription) {
      header('Content-Description: File Transfer');
    }
    header('Content-Disposition: ' . $disposition . '; filename=' . $file->file_name);
    header('Content-Type: ' . $file->mime_type);
    header('Content-Length: ' . strlen($file->data));
    header('Expires: 0');
    header('Cache-Control: no-cache');
    header('Pragma: public');

    echo $file->data;
    exit;
  }
}
