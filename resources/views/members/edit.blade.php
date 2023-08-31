<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Edit Member"/>
  </x-slot>

  <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('members.update', $member->id) }}" cancel-route="{{ route('members.cancel') }}">
      @include('members.form')
    </x-edit-form>
  </div>
</x-app-layout>
