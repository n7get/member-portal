<x-app-layout>
    <x-slot name="header">
        <x-heading heading="Create New New Capability" \/>
    </x-slot>

  <div>
    <x-create-form submit-route="{{ route('capabilities.store') }}" cancel-route="{{ route('capabilities.index') }}">
      @include('admin.capabilities.capability')
    </x-create-form>
  </div>
</x-app-layout>
