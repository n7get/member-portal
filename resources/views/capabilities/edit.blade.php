<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit Capability" \/>
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('capabilities.update', $capability->id) }}" cancel-route="{{ route('capabilities.index') }}">
      @include('capabilities.form')
    </x-edit-form>
  </div>
</x-app-layout>
