<x-app-layout>
  <x-slot name="header">
      <x-heading heading="Edit Capability" \/>
  </x-slot>

  <div>
    <x-edit-form submit-route="{{ route('capabilities.update', $capability->id) }}" cancel-route="{{ route('capabilities.index') }}">
      @include('admin.capabilities.capability')
    </x-edit-form>
  </div>
</x-app-layout>
