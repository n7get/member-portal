<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Resource Categories" right-nav-route="categories.create" />
    </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="border-b-2 sm:border-none mx-2 hidden sm:flex gap-2">
      <div class="basis-11/12 flex gap-2">
        <div class="font-bold basis-4/12 underline">Name</div>
        <div class="font-bold basis-5/12 underline">Description</div>
        <div class="font-bold basis-2/12 underline">Access</div>
        <div class="font-bold basis-1/12 text-center underline">Order</div>
      </div>
      <div class="basis-1/12"></div>
    </div>
    @foreach($categories as $category)
      <div class="border-b-2 sm:border-none mx-2 mt-2 pb-2 flex gap-2">
        <div class="basis-4/5 sm:basis-11/12 sm:flex gap-2">
          <div class="basis-4/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap font-extrabold sm:font-normal">
            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
          </div>
          <div class="basis-5/12 text-sm sm:text-lg sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">{{ $category->description }}</div>
          <div class="sm:basis-2/12">
            <span class="sm:hidden inline-block text-sm mr-1">Access:</span>
            <span class="text-sm sm:text-lg">{{ $category->access }}</span>
          </div>
          <div class="sm:basis-1/12 sm:text-center">
            <span class="sm:hidden inline-block text-sm mr-1">Order:</span>
            <span class="text-sm sm:text-lg">{{ $category->order }}</span>
          </div>
        </div>
        <div class="basis-1/5 sm:basis-1/12 flex gap-2 justify-end items-center">
            <a href="{{ route('categories.edit', $category->id) }}">
                <x-icons.edit />
            </a>
            <div class="delete-category cursor-pointer" data-url="{{ route('categories.destroy', $category->id) }}" >
                <x-icons.delete />
            </div>
        </div>
      </div>
    @endforeach

    <x-confirm-delete-modal open-modal-button-class="delete-category" type="category" />
</x-app-layout>
