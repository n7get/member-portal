<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Attending {{ $activity->name }}" />
  </x-slot>

  <div class="page">
    <div class="max-w-3xl container">
      <x-success />

      <div class="panel">
        <div class="flex gap-2">
          <div>Description:</div>
          <div>{{ $activity->description }}</div>
        </div>
        <div class="flex gap-2">
          <div>Type:</div>
          <div>{{ $activity->activityType->description }}</div>
        </div>
        <div class="flex gap-2">
          <div>Date:</div>
          <div>{{ $activity->date }}</div>
        </div>
        <div class="flex gap-2">
          <div>Duration:</div>
          <div>{{ $activity->duration }}</div>
        </div>
        <div class="flex gap-2">
          <div>Location:</div>
          <div>{{ $activity->location }}</div>
        </div>
        <div class="flex gap-2">
          <div>Notes:</div>
          <div>{{ $activity->notes }}</div>
        </div>
        <div class="mt-4 flex gap-2 justify-between">
          <div class="flex gap-2">
            <div>Attending</div>
            <div>{{ $activity->logs()->count() ? 'Yes' : 'No' }}</div>
          </div>
          <div class="flex gap-2 justify-end">
            <form action="{{ route('activities.update.attending', $activity->id)}}" method="POST">
              @csrf
              <x-primary-button>
                {{ $activity->logs()->count() ? 'Not Attending' : "I'm Attending" }}
              </x-primary-button>
              <a href="{{ route('dashboard' )}}">
                <x-secondary-button>Dashboard</x-secondary-button>
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
