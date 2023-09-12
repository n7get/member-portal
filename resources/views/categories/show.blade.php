<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $category->name }}" right-nav-route="categories.edit" right-nav-id="{{ $category->id }}" />
  </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="mx-2">
      <div class="flex gap=2 mt-4">
        <div>Name:</div>
        <div>{{ $category->name }}</div>
      </div>
      <div class="flex gap=2 mt-2">
        <div>Description:</div>
        <div>{{ $category->description }}</div>
      </div>
      <div class="flex gap=2 mt-2">
        <div>Access:</div>
        <div>{{ $category->access }}</div>
      </div>
      <div class="flex gap=2 mt-2">
        <div>Order:</div>
        <div>{{ $category->order }}</div>
      </div>
      <div class="flex gap=2 mt-2">
        <div>Created at:</div>
        <div>{{ $category->created_at }}</div>
      </div>
      <div class="flex gap=2 mt-2">
        <div>Updated at:</div>
        <div>{{ $category->updated_at }}</div>
      </div>
    </div>

    <div class="flex justify-between bg-gray-300 px-2 py-3">
      <div>Resource Files</div>
      <div class="ml-2">
        <a href="{{ route('categories.files.create', $category->id) }}">
          <x-plus-icon />
        </a>
      </div>
    </div>
    <div class="flex gap-2 border-b-2 sm:border-none mx-2">
      <div class="font-bold basis-3/12 underline">Name</div>
      <div class="font-bold basis-4/12 underline">Description</div>
      <div class="font-bold basis-1/12 underline">Order</div>
      <div class="font-bold basis-2/12 underline">Access</div>
      <div class="font-bold basis-1/12 underline">Version</div>
      <div class="font-bold basis-1/12"></div>
    </div>
    @foreach ($category->files as $file)
      <div class="flex gap-2 mx-2">
        <div class="basis-3/12 text-ellipsis overflow-hidden whitespace-nowrap">
          <a href="{{ route('files.show', $file->id) }}">{{ $file->name }}</a>
        </div>
        <div class="basis-4/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $file->description }}</div>
        <div class="basis-1/12">{{ $file->pivot->order }}</div>
        <div class="basis-2/12">{{ $file->access }}</div>
        <div class="basis-1/12">{{ $file->version }}</div>
        <div class="basis-1/12 flex gap-2 justify-end">
          <a href="{{ route('categories.files.edit', [$category, $file]) }}">
            <x-edit-icon />
          </a>
          <div class="delete-category-file cursor-pointer" data-url="{{ route('categories.files.destroy', [$category, $file]) }}" >
            <x-delete-icon />
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-category-file" type="categories" />
</x-app-layout>
