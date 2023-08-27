<x-app-layout>
  <x-slot name="header">
    <x-heading heading="Create New Other Skills And Equipment" />
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('others.store') }}" cancel-route="{{ route('others.index') }}">
      @include('admin.others.form')
    </x-create-form>
  </div>
</x-app-layout>
