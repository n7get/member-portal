<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $file->name }}" right-nav-route="files.edit" right-nav-id="{{ $file->id }}" />
  </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="flex mt-4">
      <div>Name:</div>
      <div class="ml-2">{{ $file->name }}</div>
    </div>
    <div class="flex mt-2">
      <div>User:</div>
      <div class="ml-2">
        <a href="{{ route('users.show', $file->user->id) }}" class="text-blue-500">{{ $file->user->name() }}</a>
      </div>
    </div>
    <div class="flex mt-2">
      <div>File Name:</div>
      <div class="ml-2">{{ $file->file_name }}</div>
    </div>
    <div class="flex mt-2">
      <div>Description:</div>
      <div class="ml-2">{{ $file->description }}</div>
    </div>
    <div class="flex mt-2">
      <div>Version:</div>
      <div class="ml-2">{{ $file->version }}</div>
    </div>
    <div class="flex mt-2">
      <div>Mime Type:</div>
      <div class="ml-2">{{ $file->mime_type }}</div>
    </div>
    <div class="flex mt-2">
      <div>Access:</div>
      <div class="ml-2">{{ $file->access }}</div>
    </div>
    {{-- <div class="flex mt-2">
      <div>Data:</div>
      <div class="ml-2">{{ $file->data }}</div>
    </div> --}}
    <div class="flex mt-2">
      <div>Created at:</div>
      <div class="ml-2">{{ $file->created_at }}</div>
    </div>
    <div class="flex mt-2">
      <div>Updated at:</div>
      <div class="ml-2">{{ $file->updated_at }}</div>
    </div>
  </div>
</x-app-layout>
