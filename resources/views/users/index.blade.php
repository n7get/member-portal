<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Users" right-nav-route="users.create" />
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <div class="panel">
        <div class="border-b-2 sm:border-none mx-2 hidden sm:flex gap-2">
        <div class="basis-11/12 flex gap-2">
          <div class="font-bold basis-1/12 underline">Roles</div>
          <div class="font-bold basis-5/12 underline">Email</div>
          <div class="font-bold basis-4/12 underline">Name</div>
          <div class="font-bold basis-2/12 underline">Callsign</div>
        </div>
        <div class="font-bold basis-1/12"></div>
      </div>
      @foreach($users as $user)
        <div class="border-b-2 sm:border-none mx-2 mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2">
          <div class="basis-4/5 sm:basis-11/12 sm:flex gap-2">
            <div class="basis-1/12 text-sm sm:text-lg">
              {{ $user->hasRole('admin') ? 'A' : '' }}
              {{ $user->hasRole('leadership') ? 'L' : '' }}
              {{ $user->hasRole('member') ? 'M' : '' }}
              {{ $user->hasRole('resources') ? 'R' : '' }}
            </div>
            <div class="basis-5/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap font-extrabold sm:font-normal">
              <a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a>
            </div>
            <div class="basis-4/12 text-sm sm:text-lg sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">{{ $user->name() }}</div>
            <div class="basis-2/12 text-sm sm:text-lg text-ellipsis overflow-hidden whitespace-nowrap">
              @if ($user->member)
              <a href="{{ route('members.show', $user->member->id) }}">
                {{ $user->member->callsign }}
              </a>
              @endif
            </div>
          </div>
          <div class="basis-1/5 sm:basis-1/12 flex gap-2 justify-end items-center">
            <a href="{{ route('users.edit', $user->id) }}">
              <x-icons.edit />
            </a>
            <div class="delete-user cursor-pointer" data-url="{{ route('users.destroy', $user->id) }}" >
              <x-icons.delete />
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <x-confirm-delete-modal open-modal-button-class="delete-user" type="user" />
</x-app-layout>
