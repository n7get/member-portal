
<div class="max-w-5xl sm:pb-2 mx-auto bg-white">
  @if (count($memberResources))
    <div class="bg-gray-300 px-2 py-3">
      Member Resources
    </div>
    <x-resource-list :resources="$memberResources" />
  @endif
</div>
