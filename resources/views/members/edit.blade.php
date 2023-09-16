<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit Member"/>
  </x-slot>

  <div class="page">
    <x-edit-form submit-route="{{ route('members.update', $member->id) }}" cancel-route="{{ route('members.cancel') }}">
      <div class="max-w-5xl container">
        @include('members.form')
      </div>
    </x-edit-form>
  </div>
</x-app-layout>
