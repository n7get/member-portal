<div class="flex justify-between">
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $heading }}
  </h2>
  @if($attributes->has('right-nav-route'))
    <div>
      <a href="{{ route($rightNavRoute, $rightNavId) }}">
        <x-icons.edit />
      </a>
    </div>
  @endif
</div>
