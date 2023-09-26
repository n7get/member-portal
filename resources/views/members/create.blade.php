<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Create New Member"/>
  </x-slot>

  <x-create-form submit-route="{{ route('members.store') }}" cancel-route="{{ route('members.cancel') }}">
    <div class="page">
      <div class="max-w-5xl container">
        @include('members.form')
      </div>
    </x-create-form>
  </div>
</x-app-layout>
