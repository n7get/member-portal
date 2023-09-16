<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Members Capabilities" right-nav-route="capabilities.create" />
  </x-slot>

  <div class="page">
    <div class="max-w-lg container">
      <div class="panel">
        <div class="border-b-2 sm:border-none flex">
          <div class="font-bold basis-8/12 underline">Description</div>
          <div class="font-bold basis-2/12 text-center underline">Order</div>
          <div class="font-bold basis-2/12"></div>
        </div>
        @foreach($capabilities as $capability)
          <div class="border-b-2 sm:border-none flex">
            <div class="basis-8/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $capability->description }}</div>
            <div class="basis-2/12 text-center">{{ $capability->order }}</div>
            <div class="basis-2/12 flex gap-2 justify-end">
              <a href="{{ route('capabilities.edit', $capability->id) }}">
                <x-icons.edit />
              </a>
              <div class="delete-capability cursor-pointer" data-url="{{ route('capabilities.destroy', $capability->id) }}" >
                <x-icons.delete />
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-capability" type="capability" />
</x-app-layout>
