<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="New User" \/>
    </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('users.store') }}" cancel-route="{{ route('users.index') }}">
      @include('users.form')
    </x-create-form>
  </div>
</x-app-layout>
