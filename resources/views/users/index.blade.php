<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Users" right-nav-route="users.create" />
    </x-slot>

    <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
        <div class="border-b-2 sm:border-none mx-2 flex">
            <div class="font-bold basis-1/12 underline"></div>
            <div class="font-bold basis-4/12 underline">Email</div>
            <div class="font-bold basis-4/12 underline">Name</div>
            <div class="font-bold basis-2/12 underline">Callsign</div>
            <div class="font-bold basis-1/12"></div>
        </div>
        @foreach($users as $user)
            <div class="border-b-2 sm:border-none mx-2 flex">
                <div class="basis-1/12">
                    {{ $user->hasRole('admin') ? 'A' : '' }}
                    {{ $user->hasRole('leadership') ? 'L' : '' }}
                    {{ $user->hasRole('member') ? 'M' : '' }}
                    {{ $user->hasRole('resources') ? 'R' : '' }}
                </div>
                <div class="basis-4/12 text-ellipsis overflow-hidden whitespace-nowrap">
                    <a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a>
                </div>
                <div class="basis-4/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $user->name() }}</div>
                <div class="basis-2/12 text-ellipsis overflow-hidden whitespace-nowrap">
                    @if ($user->member)
                        <a href="{{ route('members.show', $user->member->id) }}">
                            {{ $user->member->callsign }}
                        </a>
                    @endif
                </div>
                <div class="basis-1/12 flex justify-end">
                    <a href="{{ route('users.edit', $user->id) }}">
                        <x-edit-icon />
                    </a>
                    <div class="delete-user ml-2 cursor-pointer" data-url="{{ route('users.destroy', $user->id) }}" >
                        <x-icons.delete />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-confirm-delete-modal open-modal-button-class="delete-user" type="user" />
</x-app-layout>
