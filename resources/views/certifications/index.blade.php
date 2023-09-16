<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Members Certifications" right-nav-route="certifications.create" />
  </x-slot>

  <div class="page">
    <div class="max-w-2xl container">
      <div class="panel">
        <div class="border-b-2 sm:border-none pb-2 sm:pb-0 flex">
          <div class="font-bold basis-8/12 underline">Description</div>
          <div class="font-bold basis-2/12 text-center underline">Order</div>
          <div class="font-bold basis-2/12"></div>
        </div>
        @foreach($certifications as $certification)
          <div class="border-b-2 sm:border-none py-4 sm:py-0 flex">
            <div class="basis-8/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $certification->description }}</div>
            <div class="basis-2/12 text-center">{{ $certification->order }}</div>
            <div class="basis-2/12 flex gap-2 justify-end">
              <a href="{{ route('certifications.edit', $certification->id) }}">
                <x-icons.edit />
              </a>
              <div class="delete-certification cursor-pointer" data-url="{{ route('certifications.destroy', $certification->id) }}" >
                <x-icons.delete />
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-certification" type="certification" />
</x-app-layout>
