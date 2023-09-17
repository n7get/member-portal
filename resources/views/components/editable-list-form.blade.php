@props([
    'submitRoute',
    'add' => 'Add',
])

<form action="{{ $submitRoute }}" method="post">
  @csrf
  {{ method_field('PUT') }}
  {{ $slot }}
  <div class="flex gap-3 justify-end pt-6">
    <x-secondary-button x-data="" x-on:click="$dispatch('add-item')">{{ $add }}</x-secondary-button>
    <x-primary-button type="submit">Save</x-primary-button>
  </div>
</form>

