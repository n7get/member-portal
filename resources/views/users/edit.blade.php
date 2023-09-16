<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit User" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('users.update', $user->id) }}" cancel-route="{{ route('users.cancel') }}">
          @include('users.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
