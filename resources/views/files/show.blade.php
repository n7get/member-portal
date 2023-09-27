<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $file->name }}" right-nav-route="files.edit" right-nav-id="{{ $file->id }}" />
  </x-slot>

  <div class="page">
    <div class="max-w-lg container">
      <div class="panel">
        <div class="flex gap-2 mt-4">
          <div>Name:</div>
          <div>{{ $file->name }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>User:</div>
          <div>
            <a class="link" href="{{ route('users.show', $file->user->id) }}">{{ $file->user->name() }}</a>
          </div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>File Name:</div>
          <div>{{ $file->file_name }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Description:</div>
          <div>{{ $file->description }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Version:</div>
          <div>{{ $file->version }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Mime Type:</div>
          <div>{{ $file->mime_type }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Access:</div>
          <div>{{ $file->access }}</div>
        </div>
        {{-- <div class="flex gap-2 mt-2">
          <div>Data:</div>
          <div>{{ $file->data }}</div>
        </div> --}}
        <div class="flex gap-2 mt-2">
          <div>Created at:</div>
          <div>{{ $file->created_at }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Updated at:</div>
          <div>{{ $file->updated_at }}</div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
