<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Create New Category" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('categories.store') }}" cancel-route="{{ route('categories.index') }}">
          @include('categories.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
