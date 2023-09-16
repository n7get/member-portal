<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Create New Certification" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form submit-route="{{ route('certifications.store') }}" cancel-route="{{ route('certifications.index') }}">
          @include('certifications.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
