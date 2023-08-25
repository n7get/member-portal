<x-app-layout>
    <x-slot name="header">
        <x-heading heading="Members Capabilities" right-nav-route="capabilities.create" />
    </x-slot>

    <div>
        <div>
            <div>Description</div>
            <div>Order</div>
        </div>
        @foreach($capabilities as $capability)
            <div>
                <div>{{ $capability->description }}</div>
                <div>{{ $capability->order }}</div>
                <div>
                    <a href="{{ route('capabilities.edit', $capability->id) }}">
                        <x-edit-icon />
                    </a>
                    <div class="ml-2">
                        <x-delete-icon />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-confirm-delete-modal type="capability"/>
</x-app-layout>
