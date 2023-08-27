<x-app-layout>
  <x-slot name="header">
      <x-heading heading="Edit Certifications" />
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('certifications.update', $certification->id) }}" cancel-route="{{ route('certifications.index') }}">
      @include('admin.certifications.form')
    </x-edit-form>
  </div>
</x-app-layout>
