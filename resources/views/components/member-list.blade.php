<div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white">
    <div class="border-b-2 hidden sm:border-none sm:flex">
        <div class="basis-4/5 sm:basis-11/12 flex">
            <div class="font-bold basis-2/12 underline">Callsign</div>
            <div class="font-bold basis-4/12 underline">Name</div>
            <div class="font-bold basis-5/12 underline">Email</div>
            <div class="font-bold basis-1/12 underline">Status</div>
        </div>
        <div class="basis-1/5 sm:basis-1/12"></div>
    </div>
  @foreach($members as $member)
    <div class="border-b-2 sm:border-none flex hover:bg-gray-2 00">
        <div class="basis-4/5 sm:basis-11/12 sm:flex">
            <div class="sm:basis-2/12 font-extrabold sm:font-normal">
                <a href="{{ route('members.show', $member->id) }}">{{ $member->callsign }}</a>
            </div>
            <div class="sm:basis-4/12 text-sm sm:text-lg sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                {{ $member->first_name }}&nbsp;{{ $member->last_name }}
            </div>
            <div class="sm:basis-5/12 text-sm sm:text-lg sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                <a href="{{ route('users.show', $member->user_id) }}">{{ $member->user->email }}</a>
            </div>
            <div class="sm:basis-1/12 text-sm sm:text-lg">
                {{ $member->status }}
            </div>
        </div>
        <div class="basis-1/5 sm:basis-1/12 flex gap-2 justify-end items-center">
            <a href="{{ route('members.edit', $member->id) }}">
                <x-icons.edit />
            </a>
            <div class="delete-member cursor-pointer" data-url="{{ route('members.destroy', $member->id) }}" >
                <x-icons.delete />
            </div>
        </div>
    </div>
    @endforeach
</div>
