<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Upload a New File" \/>
    </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form
      submit-route="{{ route('files.store') }}"
      cancel-route="{{ route('files.index') }}"
      enctype="multipart/form-data"
    >
      @include('files.form')
    </x-create-form>
  </div>
</x-app-layout>
