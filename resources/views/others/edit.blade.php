<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Edit Other Skills And Equipment" />
  </x-slot>

  <div class="page">
    <div class="max-w-sm container">
      <div class="panel">
        <x-edit-form submit-route="{{ route('others.update', $other->id) }}" cancel-route="{{ route('others.index') }}">
          @include('others.form')
        </x-edit-form>
      </div>
    </div>
  </div>
</x-app-layout>
