<div class="flex justify-between">
    <h2>
        {{ $heading }}
    </h2>
    @if($attributes->has('right-nav-route'))
        <div class="">
            <a href="{{ route($rightNavRoute) }}">
                <x-icons.plus />
            </a>
        </div>
    @endif
</div>
