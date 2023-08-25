<x-app-layout>
    <x-slot name="header">
        <x-heading heading="Members Certifications" right-nav-route="certifications.create" />
    </x-slot>

    <div>
        <div>
            <div>Description</div>
            <div>Order</div>
        </div>
        @foreach($certifications as $certification)
            <div>
                <div>{{ $certification->description }}</div>
                <div>{{ $certification->order }}</div>
                <div>
                    <a href="{{ route('certifications.edit', $certification->id) }}">
                        <x-edit-icon />
                    </a>
                    <div class="ml-2">
                        <x-delete-icon />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-confirm-delete-modal type="certification"/>
</x-app-layout>
