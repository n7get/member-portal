<form action="{{ $submitRoute }}" method="post">
    @csrf
    {{ method_field('PUT') }}
    <div class="py-2 px-2">
        {{ $slot }}
        <div class="flex flex-row justify-end pt-3">
            <x-primary-button type="submit">Update</x-primary-button>
            <a href="{{ $cancelRoute }}"><x-secondary-button class="ml-3">Cancel</x-secondary-button></a>
        </div>
    </div>
</form>
