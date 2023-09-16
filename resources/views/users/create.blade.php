<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="New User" \/>
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('users.store') }}" cancel-route="{{ route('users.index') }}">
          @include('users.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
