<x-app-layout>
  <x-slot name="header">
    <x-heading heading="Other skills and equipment that you would agree to use"
      right-nav-route="others.create" />
  </x-slot>

  <div class="max-w-3xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="border-b-2 sm:border-none mx-2 sm:flex">
      <div class="font-bold basis-5/12 underline">Description</div>
      <div class="font-bold basis-1/12 text-center underline">Extra</div>
      <div class="font-bold basis-4/12 underline">Prompt</div>
      <div class="font-bold basis-1/12 text-center underline">Order</div>
      <div class="basis-1/12"></div>
    </div>
      @foreach($others as $other)
      <div class="border-b-2 sm:border-none mx-2 sm:flex">
        <div class="basis-5/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $other->description }}</div>
        <div class="basis-1/12 text-center">
          @if($other->needs_extra_info)
            <svg class="inline w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
</svg>
          @endif
        </div>
        <div class="basis-4/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $other->prompt }}</div>
        <div class="basis-1/12 text-center">{{ $other->order }}</div>
        <div class="basis-1/12 flex justify-end">
            <a href="{{ route('others.edit', $other->id) }}">
                <x-edit-icon />
            </a>
            <div class="delete-other ml-2 cursor-pointer" data-url="{{ route('others.destroy', $other->id) }}" >
                <x-delete-icon />
            </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-other" type="other" />
</x-app-layout>
