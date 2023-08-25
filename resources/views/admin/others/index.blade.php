<x-app-layout>
  <x-slot name="header">
    <x-heading heading="Other skills and equipment that you would agree to use"
      right-nav-route="others.create" />
  </x-slot>

  <div>
      <div>Description</div>
      <div>Data</div>
      <div>Prompt</div>
      <div>Order</div>
  </div>
  @foreach($others as $other)
    <div>
      <div>{{ $other->description }}</div>
      <div>
        @if($other->data)
          <i></i>
        @endif
      </div>
      <div>{{ $other->prompt }}</div>
      <div>{{ $other->order }}</div>
      <div>
          <a href="{{ route('others.edit', $other->id) }}">
              <x-edit-icon />
          </a>
          <div class="ml-2">
              <x-delete-icon />
          </div>
      </div>
    </div>
  @endforeach

  <x-confirm-delete-modal type="other"/>
</x-app-layout>
