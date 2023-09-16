<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Create New Member"/>
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <x-create-form submit-route="{{ route('members.store') }}" cancel-route="{{ route('members.cancel') }}">
        @include('members.form')
      </x-create-form>
    </div>
  </div>
</x-app-layout>
