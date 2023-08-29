<x-app-layout>
  <x-slot name="header">
      <x-heading heading="Edit User" \/>
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('users.update', $user->id) }}" cancel-route="{{ route('users.index') }}">
      @include('users.form')
    </x-edit-form>
  </div>
</x-app-layout>
