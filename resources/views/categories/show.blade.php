<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $category->name }}" right-nav-route="categories.edit" right-nav-id="{{ $category->id }}" />
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <div class="panel">
        <div class="flex gap-2 mt-4">
          <div>Name:</div>
          <div>{{ $category->name }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Description:</div>
          <div>{{ $category->description }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Access:</div>
          <div>{{ $category->access }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Order:</div>
          <div>{{ $category->order }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Created at:</div>
          <div>{{ $category->created_at }}</div>
        </div>
        <div class="flex gap-2 mt-2">
          <div>Updated at:</div>
          <div>{{ $category->updated_at }}</div>
        </div>
      </div>

      <div class="panel">
        <div class="panel-header flex justify-between">
          <div>Resource Files</div>
          <div>
            <a href="{{ route('categories.files.create', $category->id) }}">
              <x-icons.plus />
            </a>
          </div>
        </div>
        <div class="mt-3 mb-1 hidden sm:flex gap-2">
          <div class="basis-11/12 flex gap-2">
            <div class="font-bold basis-4/12 underline">Name</div>
            <div class="font-bold basis-4/12 underline">Description</div>
            <div class="font-bold basis-1/12 underline text-center">Order</div>
            <div class="font-bold basis-2/12 underline">Access</div>
            <div class="font-bold basis-1/12 underline">Version</div>
          </div>
          <div class="font-bold basis-1/12"></div>
        </div>
        @foreach ($category->files as $file)
          <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2">
            <div class="basis-4/5 sm:basis-11/12 sm:flex gap-2">
              <div class="basis-4/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap font-extrabold sm:font-normal">
                <a href="{{ route('files.show', $file->id) }}">{{ $file->name }}</a>
              </div>
              <div class="basis-4/12 text-sm sm:text-lg sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">{{ $file->description }}</div>
              <div class="sm:basis-1/12 sm:text-center">
                <span class="sm:hidden inline-block text-sm mr-1">Order:</span>
                <span class="text-sm sm:text-lg">{{ $file->pivot->order }}</span>
              </div>
              <div class="sm:basis-2/12">
                <span class="sm:hidden inline-block text-sm mr-1">Access:</span>
                <span class="text-sm sm:text-lg">{{ $file->access }}</span>
              </div>
              <div class="sm:basis-1/12">
                <span class="sm:hidden inline-block text-sm mr-1">Version:</span>
                <span class="text-sm sm:text-lg">{{ $file->version }}</span>
              </div>
            </div>
            <div class="basis-1/5 sm:basis-1/12 flex gap-2 justify-end items-center">
                <a href="{{ route('categories.files.edit', [$category, $file]) }}">
                    <x-icons.edit />
                </a>
                <div class="delete-category-file cursor-pointer" data-url="{{ route('categories.files.destroy', [$category, $file]) }}" >
                    <x-icons.delete />
                </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-category-file" type="categories" />
</x-app-layout>
