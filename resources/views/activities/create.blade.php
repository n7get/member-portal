<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Upload a New File" />
  </x-slot>

  <div class="page">
    <div class="max-w-2xl container">
      <div class="panel">
        <x-create-form
          submit-route="{{ route('activities.store') }}"
          cancel-route="{{ route('activities.index') }}"
          enctype="multipart/form-data"
        >
          @include('activities.form')
        </x-create-form>
      </div>
    </div>
  </div>
</x-app-layout>
