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
          <div class="flex gap-2 justify-center text-red-800">
            <x-icons.exclamation class="h-6 w-6" />
            <div>
              You staii need to submit a membership application.
            </div>
          </div>
          <div class="flex justify-center mt-4">
            <x-primary-button>
              <a href="{{ route('members.create') }}">
                Click here to get started.
              </a>
            </x-primary-button>
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
