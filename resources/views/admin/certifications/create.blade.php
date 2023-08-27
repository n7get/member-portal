<x-app-layout>
  <x-slot name="header">
      <x-heading heading="Create New New Certification" />
  </x-slot>

  <div>
    <x-create-form submit-route="{{ route('certifications.store') }}" cancel-route="{{ route('certifications.index') }}">
      @include('admin.certifications.form')
    </x-create-form>
  </div>
</x-app-layout>
