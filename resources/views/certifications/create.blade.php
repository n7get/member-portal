<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Create New New Certification" />
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('certifications.store') }}" cancel-route="{{ route('certifications.index') }}">
      @include('certifications.form')
    </x-create-form>
  </div>
</x-app-layout>
