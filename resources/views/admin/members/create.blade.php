<x-app-layout>
  <x-slot name="header">
      <x-heading heading="Create New Member"/>
  </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-create-form submit-route="{{ route('members.store') }}" cancel-route="{{ route('members.index') }}">
      @include('admin.members.form')
    </x-create-form>
  </div>
</x-app-layout>
