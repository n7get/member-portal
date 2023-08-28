<x-app-layout>
    <x-slot name="header">
        <x-heading heading="Members" right-nav-route="members.create" />
    </x-slot>

    <div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
        @foreach($members as $member)
            <div class="border-b-2 sm:border-none mx-2 sm:flex">
                <div class="basis-4/12 text-ellipsis overflow-hidden">{{ $member->first_name }}&nbsp;{{ $member->last_name }}</div>
                <div class="basis-2/12">{{ $member->callsign }}</div>
                <div class="basis-2/12 flex justify-end">
                    <a href="{{ route('members.edit', $member->id) }}">
                        <x-edit-icon />
                    </a>
                    <div class="delete-member ml-2 cursor-pointer" data-url="{{ route('members.destroy', $member->id) }}" >
                        <x-delete-icon />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-confirm-delete-modal open-modal-button-class="delete-member" type="member" />
</x-app-layout>
