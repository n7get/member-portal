<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      @if ($user->needsMember())
        <div class="panel">
          <div class="flex gap-2 text-red-800">
            <x-icons.exclamation class="h-6 w-6" />
            <div>
              You staii need to submit a membership application.
            </div>
          </div>
          <div class="flex justify-center mt-6">
            <x-primary-button>
              <a href="{{ route('members.create') }}">
                Click here to get started.
              </a>
            </x-primary-button>
          </div>
        </div>
      @endif
      @if ($user->member?->status == 'pending')
        <div class="panel">
          <div class="flex gap-2 text-red-800">
            <x-icons.exclamation class="h-6 w-6" />
            <div>
              Your membership application is pending approval.
            </div>
          </div>
        </div>
      @endif

      {{-- @role('admin')
      @endrole --}}

      @role('leadership')
        @if (count($pendingMembers))        
          <div class="panel">
            <div class="panel-header">
              Users with pending membership applications
            </div>
            <x-member-list :members="$pendingMembers" />
          </div>
        @endif

        @if (count($leadershipResources))
          <div class="panel">
            <div class="panel-header">
              Leadership Resources
            </div>
            <x-resource-list :resources="$leadershipResources" />        
          </div>
        @endif
      @endrole

      @role('member')
        @if (count($unloggedActivityLogs))
          <div class="panel">
            <div class="panel-header">Unlogged activities</div>
            <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
              <div class="w-5/12 font-bold underline">Description</div>
              <div class="w-3/12 font-bold underline">Date</div>
              <div class="w-2/12 font-bold underline">Duration</div>
              <div class="w-2/12 font-bold underline">Location</div>
            </div>
            @foreach ($unloggedActivityLogs as $activityLog)
              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 hover:bg-gray-100"">
                <div class="sm:w-5/12 sm:truncate font-extrabold sm:font-normal">
                  <a class="link" href="{{ route('activities.logs', $activityLog->activity_logs_id) }}">{{ $activityLog->activities_description }}</a>
                </div>
                <div class="sm:w-3/12 text-sm sm:text-lg">{{ $activityLog->activities_date }}</div>
                <div class="sm:w-2/12">
                  <span class="sm:hidden inline-block text-sm mr-1">Duration:</span>
                  <span class="text-sm sm:text-lg">{{ $activityLog->activities_duration }}</span>
                </div>
                <div class="sm:w-2/12">
                  <span class="sm:hidden inline-block text-sm mr-1">Location:</span>
                  <span class="text-sm sm:text-lg">{{ $activityLog->activities_location }}</span>
                </div>
              </div>
            @endforeach
          </div>
        @endif

        @if (count($futureActivities))
          <div class="panel">
            <div class="panel-header">Upcoming activities</div>
            <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
              <div class="w-4/12 font-bold underline">Description</div>
              <div class="w-3/12 font-bold underline">Date</div>
              <div class="w-2/12 font-bold underline">Duration</div>
              <div class="w-2/12 font-bold underline">Location</div>
              <div class="w-1/12 font-bold underline">Att</div>
            </div>
            @foreach ($futureActivities as $activity)
              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 hover:bg-gray-100"">
                <div class="sm:w-4/12 sm:truncate font-extrabold sm:font-normal">
                  <a class="link" href="{{ route('activities.attending', $activity->id) }}">{{ $activity->description }}</a>
                </div>
                <div class="sm:w-3/12 text-sm sm:text-lg">{{ $activity->date }}</div>
                <div class="sm:w-2/12">
                  <span class="sm:hidden inline-block text-sm mr-1">Duration:</span>
                  <span class="text-sm sm:text-lg">{{ $activity->duration }}</span>
                </div>
                <div class="sm:w-2/12">
                  <span class="sm:hidden inline-block text-sm mr-1">Location:</span>
                  <span class="text-sm sm:text-lg">{{ $activity->location }}</span>
                </div>
                <div class="sm:w-1/12">
                  @if ($activity->attending)
                    <x-icons.check class="h-6 w-6" />
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @endif

        @if (count($memberResources))
          <div class="panel">
            <div class="panel-header">
              Member Resources
            </div>
            <x-resource-list :resources="$memberResources" />
          </div>
        @endif
      @endrole
    </div>
  </div>
</x-app-layout>
