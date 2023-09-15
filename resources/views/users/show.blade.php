<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Member {{ $user->name() }}" right-nav-route="users.edit" right-nav-id="{{ $user->id }}" />
  </x-slot>

  <div class="max-w-lg sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    <div class="flex mt-2">
      <div>Email:</div>
      <div class="ml-2 cursor-pointer">
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
      </div>
    </div>
    @if ($user->member)
      <div class="flex mt-2">
        <div>Name:</div>
        <div class="ml-2">{{ $user->name() }}</div>
      </div>
      <div class="flex mt-2">
        <div>Callsign:</div>
        <div class="ml-2">
          @role('admin')
            <a href="{{ route('members.show', $user->member->id) }}" class="text-blue-500">
          @endrole
              {{ $user->member->callsign }}
          @role('admin')
            </a>
          @endrole
        </div>
      </div>
      <div class="flex mt-2">
        <div>Status:</div>
        <div class="ml-2">{{ $user->member->status }}</div>
      </div>
    @else
        <a href="{{ route('members.create-for-user', $user->id) }}">
          <x-primary-button>Create member</x-primary-button>
        </a>
    @endif
    <div class="flex mt-2">
      <div>Email verified at:</div>
      <div class="ml-2">{{ $user->email_verified_at }}</div>
    </div>
    <div class="flex mt-2">
      <div>Rember token:</div>
      <div class="ml-2">{{ $user->remember_token }}</div>
    </div>
    <div class="flex mt-2">
      <div>Created at:</div>
      <div class="ml-2">{{ $user->created_at }}</div>
    </div>
    <div class="flex mt-2">
      <div>Updated at:</div>
      <div class="ml-2">{{ $user->updated_at }}</div>
    </div>
  </div>
</x-app-layout>
