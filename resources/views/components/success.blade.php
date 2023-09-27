@if ($success = Session::get('success'))
  <div x-data="{ open: true }" x-show="open" x-ref="success" class="panel p-8 bg-yellow-100 flex justify-between">
    <div>{{ $success }}</div>
    <div @click="open = false; $nextTick(() => $refs.success.remove())" class="cursor-pointer">
      <x-icons.close />
    </div>
  </div>
@endif
