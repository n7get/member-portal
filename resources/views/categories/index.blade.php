<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Resource Categories" right-nav-route="categories.create" />
    </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="border-b-2 sm:border-none mx-2 flex">
      <div class="font-bold basis-2/12 underline">Name</div>
      <div class="font-bold basis-4/12 ml-3 underline">Description</div>
      <div class="font-bold basis-2/12 ml-3 underline">Access</div>
      <div class="font-bold basis-2/12 text-center underline">Order</div>
      <div class="font-bold basis-2/12"></div>
    </div>
    @foreach($categories as $category)
      <div class="border-b-2 sm:border-none mx-2 flex">
        <div class="basis-2/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $category->name }}</div>
        <div class="basis-4/12 ml-3 text-ellipsis overflow-hidden whitespace-nowrap">{{ $category->description }}</div>
        <div class="basis-2/12 ml-3">{{ $category->access }}</div>
        <div class="basis-2/12 text-center">{{ $category->order }}</div>
        <div class="basis-2/12 flex justify-end">
          <a href="{{ route('categories.edit', $category->id) }}">
            <x-edit-icon />
          </a>
          <div class="delete-category ml-2 cursor-pointer" data-url="{{ route('categories.destroy', $category->id) }}" >
            <x-delete-icon />
          </div>
        </div>
      </div>
    @endforeach

    <x-confirm-delete-modal open-modal-button-class="delete-category" type="category" />
</x-app-layout>
