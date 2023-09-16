<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Create New Capability" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('capabilities.store') }}" cancel-route="{{ route('capabilities.index') }}">
          @include('capabilities.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
