<x-app-layout>
  <x-slot name="header">
    <x-heading-edit heading="Edit Capability" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('capabilities.update', $capability->id) }}" cancel-route="{{ route('capabilities.index') }}">
          @include('capabilities.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
