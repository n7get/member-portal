@props([
    'enctype' => 'application/x-www-form-urlencoded',
    'cancelRoute',
    'submitRoute',
])

<form action="{{ $submitRoute }}" method="post" enctype="{{ $enctype }}">
    @csrf
    {{ $slot }}
    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button type="submit">Create</x-primary-button>
        <a href="{{ $cancelRoute }}"><x-secondary-button>Cancel</x-secondary-button></a>
    </div>
</form>
