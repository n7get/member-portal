<div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white">
  <div class="border-b-2 hidden sm:border-none sm:flex">
    <div class="w-4/5 sm:w-11/12 flex">
      <div class="font-bold w-2/12 underline">Callsign</div>
      <div class="font-bold w-4/12 underline">Name</div>
      <div class="font-bold w-5/12 underline">Email</div>
      <div class="font-bold w-1/12 underline">Status</div>
    </div>
    <div class="w-1/5 sm:w-1/12"></div>
  </div>
  @foreach($members as $member)
  <div class="border-b-2 sm:border-none flex hover:bg-gray-100">
    <div class="w-4/5 sm:w-11/12 sm:flex">
      <div class="sm:w-2/12 font-extrabold sm:font-normal">
        <a class="link" href="{{ route('members.show', $member->id) }}">{{ $member->callsign }}</a>
      </div>
      <div class="sm:w-4/12 text-sm sm:text-lg sm:truncate">
        {{ $member->first_name }}&nbsp;{{ $member->last_name }}
      </div>
      <div class="sm:w-5/12 text-sm sm:text-lg sm:truncate">
        <a class="link" href="{{ route('users.show', $member->user_id) }}">{{ $member->user->email }}</a>
      </div>
      <div class="sm:w-1/12 text-sm sm:text-lg">
        {{ $member->status }}
      </div>
    </div>
    <div class="w-1/5 sm:w-1/12 flex gap-2 justify-end items-center">
      <a href="{{ route('members.edit', $member->id) }}">
        <x-icons.edit />
      </a>
      <div x-data="modalData()" @click="openModal()" class="cursor-pointer" data-type="member" data-url="{{ route('members.destroy', $member->id) }}" >
        <x-icons.delete />
      </div>
    </div>
  </div>
  @endforeach
</div>

<x-confirm-delete-modal />
