<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Edit File" />
  </x-slot>

  <div class="page">
    <div class="max-w-2xl container">
      <div class="panel">
        <x-edit-form
          submit-route="{{ route('activities.update', $activity->id) }}"
          cancel-route="{{ route('activities.index') }}"
          enctype="multipart/form-data"
        >
          @include('activities.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
