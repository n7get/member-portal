<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Create New Other Skills And Equipment" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('others.store') }}" cancel-route="{{ route('others.index') }}">
          @include('others.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
