@props([
    'submitRoute',
    'emit' => null,
    'add' => 'Add',
])

<form action="{{ $submitRoute }}" method="post">
  @csrf
  {{ method_field('PUT') }}
  {{ $slot }}
  <div class="flex gap-3 justify-end pt-6">
    @if ($emit)
      <x-add-button x-data="listData()" @click.prevent="$dispatch('{{ $emit }}')">{{ $add }}</x-add-button>      
    @endif
    <x-primary-button type="submit">Save</x-primary-button>
  </div>
</form>

