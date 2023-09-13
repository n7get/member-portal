<x-app-layout>
    <x-slot name="header">
        <x-heading-create heading="Members Capabilities" right-nav-route="capabilities.create" />
    </x-slot>

    <div class="max-w-sm sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
        <div class="border-b-2 sm:border-none mx-2 flex">
            <div class="font-bold basis-8/12 underline">Description</div>
            <div class="font-bold basis-2/12 text-center underline">Order</div>
            <div class="font-bold basis-2/12"></div>
        </div>
        @foreach($capabilities as $capability)
            <div class="border-b-2 sm:border-none mx-2 flex">
                <div class="basis-8/12 text-ellipsis overflow-hidden whitespace-nowrap">{{ $capability->description }}</div>
                <div class="basis-2/12 text-center">{{ $capability->order }}</div>
                <div class="basis-2/12 flex justify-end">
                    <a href="{{ route('capabilities.edit', $capability->id) }}">
                        <x-edit-icon />
                    </a>
                    <div class="delete-capability ml-2 cursor-pointer" data-url="{{ route('capabilities.destroy', $capability->id) }}" >
                        <x-icons.delete />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-confirm-delete-modal open-modal-button-class="delete-capability" type="capability" />
</x-app-layout>
