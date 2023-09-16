<!-- Description -->
<div class="mt-3">
  <x-input-label for="description">Description:</x-input-label>
  <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $other->description)" autofocus required />
  <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<!-- Order -->
<div class="mt-3">
  <x-input-label for="order">Order:</x-input-label>
  <x-text-input id="order" class="block mt-1 w-20" type="number" name="order" :value="old('order', $other->order)" required />
  <x-input-error :messages="$errors->get('order')" class="mt-2" />
</div>

<!-- Has Extra Info -->
<div class="block mt-4">
  <input type="hidden" name="needs_extra_info" value="0">
  <label for="needs_extra_info" class="inline-flex gap-2 items-center">
    <input id="needs_extra_info" name="needs_extra_info" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" @checked(old('needs_extra_info', $other->needs_extra_info))>
    <span class="text-sm text-gray-600">Has extra info</span>
  </label>
</div>

<!-- Optional Extra Info Prompt -->
<div class="mt-3">
  <x-input-label for="prompt">Optional extra info prompt:</x-input-label>
  <x-text-input id="prompt" class="block mt-1 w-full" type="text" name="prompt" :value="old('prompt', $other->prompt)" />
  <x-input-error :messages="$errors->get('prompt')" class="mt-2" />
</div>
