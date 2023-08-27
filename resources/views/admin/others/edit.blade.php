<x-app-layout>
  <x-slot name="header">
    <x-heading heading="Edit Other Skills And Equipment" />
  </x-slot>

  <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <x-edit-form submit-route="{{ route('others.update', $other->id) }}" cancel-route="{{ route('others.index') }}">
      @include('admin.others.other')
    </x-edit-form>
  </div>
</x-app-layout>
