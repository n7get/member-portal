<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Add File To Category" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('categories.files.store', $category) }}" cancel-route="{{ route('categories.show', $category) }}">
          @include('categories.files.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
