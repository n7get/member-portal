<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Add File To Category" \/>
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('categories.files.store', $category) }}" cancel-route="{{ route('categories.show', $category) }}">
      @include('categories.files.form')
    </x-create-form>
  </div>
</x-app-layout>
