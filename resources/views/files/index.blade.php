<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Resource Files" right-nav-route="files.create" />
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <div class="panel">
        <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
          <div class="w-11/12 flex gap-2">
            <div class="w-4/12 font-bold underline">Name</div>
            <div class="w-5/12 font-bold underline">Description</div>
            <div class="w-1/12 font-bold underline">Version</div>
            <div class="w-2/12 font-bold underline">Access</div>
          </div>
          <div class="w-1/12"></div>
        </div>
        @foreach($files as $file)
          <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 hover:bg-gray-100"">
            <div class="w-4/5 sm:w-11/12 sm:flex gap-2">
              <div class="sm:w-4/12 sm:truncate font-extrabold sm:font-normal">
                <a href="{{ route('files.show', $file->id) }}">{{ $file->name }}</a>
              </div>
              <div class="sm:w-5/12 text-sm sm:text-lg sm:truncate">{{ $file->description }}</div>
              <div class="sm:w-1/12">
                <span class="sm:hidden inline-block text-sm mr-1">Version:</span>
                <span class="text-sm sm:text-lg">{{ $file->version }}</span>
              </div>
              <div class="sm:w-2/12">
                <span class="sm:hidden inline-block text-sm mr-1">Access:</span>
                <span class="text-sm sm:text-lg">{{ $file->access }}</span>
              </div>
            </div>
            <div class="w-1/5 sm:w-1/12 flex gap-2 justify-end items-center">
              <a href="{{ route('files.edit', $file->id) }}">
                <x-icons.edit />
              </a>
              <div x-data="modalData()" @click="openModal()" class="cursor-pointer" data-type="file" data-url="{{ route('files.destroy', $file->id) }}">
                <x-icons.delete />
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-confirm-delete-modal />
</x-app-layout>
