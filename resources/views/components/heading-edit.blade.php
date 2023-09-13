<div class="flex justify-between">
    <h2>
        {{ $heading }}
    </h2>
    @if($attributes->has('right-nav-route'))
        <div class="ml-2">
            <a href="{{ route($rightNavRoute, $rightNavId) }}">
                <x-icons.edit />
            </a>
        </div>
    @endif
</div>
