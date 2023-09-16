<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Edit Certification" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('certifications.update', $certification->id) }}" cancel-route="{{ route('certifications.index') }}">
          @include('certifications.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
