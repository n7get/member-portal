<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($user->needsMember())
        <div class="max-w-3xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
            <div class="flex justify-center text-red-800">
                <x-exclamation-icon class="h-6 w-6" />
                <div class="ml-2">
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

    @role('admin')
        <x-dashboard-admin :user="$user" />
    @endrole

    @role('leadership')
        <x-dashboard-leadership
            :pendingMembers="$pendingMembers"
            :leadershipResources="$leadershipResources"
            :user="$user"
        />
    @endrole

    @role('member')
        <x-dashboard-member
            :memberResources="$memberResources"
            :user="$user"
        />
    @endrole
</x-app-layout>
