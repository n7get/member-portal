<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Upload a New File" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-create-form
          submit-route="{{ route('files.store') }}"
          cancel-route="{{ route('files.index') }}"
          enctype="multipart/form-data"
        >
          @include('files.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
