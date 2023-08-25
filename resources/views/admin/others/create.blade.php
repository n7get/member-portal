<x-app-layout>
  <x-slot name="header">
    <x-heading heading="Create New Other Skills And Equipment" />
  </x-slot>

  <div>
    <x-create-form submit-route="{{ route('others.store') }}" cancel-route="{{ route('others.index') }}">
      @include('admin.others.other')
    </x-create-form>
  </div>
</x-app-layout>
