<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Create New New Category" \/>
    </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('categories.store') }}" cancel-route="{{ route('categories.index') }}">
      @include('categories.form')
    </x-create-form>
  </div>
</x-app-layout>
