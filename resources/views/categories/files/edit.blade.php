<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Edit Category" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('categories.files.update', [$category, $file]) }}" cancel-route="{{ route('categories.show', $category) }}">
          @include('categories.files.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
