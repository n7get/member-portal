<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Members" />
    </x-slot>

    <x-member-list :members="$members" />

    <x-confirm-delete-modal open-modal-button-class="delete-member" type="member" />
</x-app-layout>
