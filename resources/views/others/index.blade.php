<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Other skills & equipment"
      right-nav-route="others.create" />
  </x-slot>

  <div class="max-w-3xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="border-b-2 sm:border-none mx-2 hidden sm:flex">
      <div class="basis-4/5 sm:basis-11/12 flex gap-2">
        <div class="font-bold basis-6/12 underline">Description</div>
        <div class="font-bold basis-1/12 text-center underline">Extra</div>
        <div class="font-bold basis-4/12 underline">Prompt</div>
        <div class="font-bold basis-1/12 text-center underline">Order</div>
      </div>
      <div class="basis-1/5 sm:basis-1/12"></div>
    </div>
      @foreach($others as $other)
      <div class="border-b-2 sm:border-none mx-2 mt-2 pb-2 flex">
        <div class="basis-4/5 sm:basis-11/12 sm:flex gap-2">
          <div class="basis-6/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap font-extrabold sm:font-normal">{{ $other->description }}</div>
          <div class="basis-1/12 sm:text-center">
            @if($other->needs_extra_info)
              <span class="sm:hidden text-sm">Has extra input</span>
              <svg class="hidden sm:inline w-5 mt-1" class="inline w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>
            @endif
          </div>
          <div class="basis-4/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
            @if($other->prompt)
              <span class="sm:hidden inline-block text-sm">Prompt:</span>
              <span class="text-sm sm:text-lg">{{ $other->prompt }}</span>
            @endif
          </div>
          <div class="basis-1/12 sm:text-center">
            <span class="sm:hidden inline-block text-sm">Order:</span>
            <span class="text-sm sm:text-lg">{{ $other->order }}</span>
          </div>
        </div>
        <div class="basis-1/5 sm:basis-1/12 flex gap-2 justify-end items-center">
            <a href="{{ route('others.edit', $other->id) }}">
                <x-icons.edit />
            </a>
            <div class="delete-other cursor-pointer" data-url="{{ route('others.destroy', $other->id) }}" >
                <x-icons.delete />
            </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-other" type="other" />
</x-app-layout>
