<x-app-layout>
  <x-slot name="header">
      <x-heading-create heading="Activities" right-nav-route="activities.create" />
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <div class="panel">
        <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
          <div class="w-11/12 flex gap-2">
            <div class="w-4/12 font-bold underline">Description</div>
            <div class="w-3/12 font-bold underline">Date</div>
            <div class="w-2/12 font-bold underline">Duration</div>
            <div class="w-3/12 font-bold underline">Location</div>
          </div>
          <div class="w-1/12"></div>
        </div>
        @foreach($activities as $activity)
          <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 hover:bg-gray-100"">
            <div class="w-4/5 sm:w-11/12 sm:flex gap-2">
              <div class="sm:w-4/12 sm:truncate font-extrabold sm:font-normal">
                <a class="link" href="{{ route('activities.show', $activity->id) }}">{{ $activity->description }}</a>
              </div>
              <div class="sm:w-3/12 text-sm sm:text-lg">{{ $activity->date }}</div>
              <div class="sm:w-2/12">
                <span class="sm:hidden inline-block text-sm mr-1">Duration:</span>
                <span class="text-sm sm:text-lg">{{ $activity->duration }}</span>
              </div>
              <div class="sm:w-3/12">
                <span class="sm:hidden inline-block text-sm mr-1">Location:</span>
                <span class="text-sm sm:text-lg">{{ $activity->location }}</span>
              </div>
            </div>

            <div class="w-1/5 sm:w-1/12 flex gap-2 justify-end items-center">
              <a href="{{ route('activities.edit', $activity->id) }}">
                <x-icons.edit />
              </a>
              <div x-data="modalData()" @click="openModal()" class="cursor-pointer" data-type="activity" data-url="{{ route('activities.destroy', $activity->id) }}">
                <x-icons.delete />
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-confirm-delete-modal />
</x-app-layout>
