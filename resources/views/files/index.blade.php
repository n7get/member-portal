<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Resource Files" right-nav-route="files.create" />
  </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="border-b-2 sm:border-none mx-2 flex">
      <div class="font-bold basis-3/12 underline">Name</div>
      <div class="font-bold basis-6/12 ml-3 underline">Description</div>
      <div class="font-bold basis-1/12 ml-3 underline">Version</div>
      <div class="font-bold basis-1/12 ml-3 underline">Access</div>
      <div class="font-bold basis-1/12"></div>
    </div>
    @foreach($files as $file)
      <div class="border-b-2 sm:border-none mx-2 flex">
        <div class="basis-3/12 text-ellipsis overflow-hidden whitespace-nowrap">
          <a href="{{ route('files.show', $file->id) }}">{{ $file->name }}</a>
        </div>
        <div class="basis-6/12 ml-3 text-ellipsis overflow-hidden whitespace-nowrap">{{ $file->description }}</div>
        <div class="basis-1/12 ml-3">{{ $file->version }}</div>
        <div class="basis-1/12 ml-3">{{ $file->access }}</div>
        <div class="basis-1/12 flex justify-end">
          <a href="{{ route('files.edit', $file->id) }}">
            <x-icons.edit />
          </a>
          <div class="delete-file ml-2 cursor-pointer" data-url="{{ route('files.destroy', $file->id) }}" >
            <x-icons.delete />
          </div>
        </div>
      </div>
    @endforeach

    <x-confirm-delete-modal open-modal-button-class="delete-file" type="file" />
  </div>
</x-app-layout>
