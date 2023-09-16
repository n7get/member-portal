<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit Category" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('categories.update', $category->id) }}" cancel-route="{{ route('categories.index') }}">
          @include('categories.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
