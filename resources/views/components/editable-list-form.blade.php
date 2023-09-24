@props([
    'submitRoute',
    'add' => 'Add',
])

<form action="{{ $submitRoute }}" method="post">
  @csrf
  {{ method_field('PUT') }}
  {{ $slot }}
  <div class="flex gap-3 justify-end pt-6">
    <x-add-button x-data="" x-on:click="$dispatch('add-item')">{{ $add }}</x-add-button>
    <x-primary-button type="submit">Save</x-primary-button>
  </div>
</form>

