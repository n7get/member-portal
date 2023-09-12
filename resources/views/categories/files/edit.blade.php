<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit Category" \/>
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('categories.files.update', [$category, $file]) }}" cancel-route="{{ route('categories.show', $category) }}">
      @include('categories.files.form')
    </x-edit-form>
  </div>
</x-app-layout>
