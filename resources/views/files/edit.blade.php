<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit File" \/>
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form
      submit-route="{{ route('files.update', $file->id) }}"
      cancel-route="{{ route('files.index') }}"
      enctype="multipart/form-data"
    >
      @include('files.form')
    </x-edit-form>
  </div>
</x-app-layout>
