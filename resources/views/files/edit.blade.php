<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Edit File" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form
          submit-route="{{ route('files.update', $file->id) }}"
          cancel-route="{{ route('files.index') }}"
          enctype="multipart/form-data"
        >
          @include('files.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
