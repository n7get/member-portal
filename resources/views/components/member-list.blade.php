<div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
  <div class="border-b-2 sm:border-none mx-2 flex">
      <div class="font-bold basis-4/12 underline">Email</div>
      <div class="font-bold basis-1/12 underline">Status</div>
      <div class="font-bold basis-2/12 underline">Callsign</div>
      <div class="font-bold basis-4/12 underline">Name</div>
      <div class="font-bold basis-1/12"></div>
  </div>
  @foreach($members as $member)
      <div class="border-b-2 sm:border-none mx-2 sm:flex">
          <div class="basis-4/12 text-ellipsis overflow-hidden">
              {{ $member->first_name }}&nbsp;{{ $member->last_name }}
          </div>
          <div class="basis-1/12">
              {{ $member->status }}
          </div>
          <div class="basis-2/12">
              <a href="{{ route('members.show', $member->id) }}">{{ $member->callsign }}</a>
          </div>
          <div class="basis-4/12 text-ellipsis overflow-hidden">
              <a href="{{ route('users.show', $member->user_id) }}">{{ $member->user->email }}</a>
          </div>
          <div class="basis-1/12 flex justify-end">
              <a href="{{ route('members.edit', $member->id) }}">
                  <x-icons.edit />
              </a>
              <div class="delete-member ml-2 cursor-pointer" data-url="{{ route('members.destroy', $member->id) }}" >
                  <x-icons.delete />
              </div>
          </div>
      </div>
  @endforeach
</div>
