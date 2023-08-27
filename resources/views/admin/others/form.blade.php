<x-error-box />

<div class="mt-2">
  <label for="description">Description:</label>
  <div class="mt-1">
    <input class="w-full type="text" id="description" name="description" value="{{ old('description', $other->description) }}" required>
  </div>
</div>

<div class="mt-2">
  <label for="order">Order:</label>
  <div class="mt-1">
    <input class="w-16 type="number" id="order" name="order" value="{{ old('order', $other->order) }}" required>
  </div>
</div>

<div class="flex items-center mt-3">
  <input type="hidden" name="needs_extra_info" value="0">
  <input type="checkbox" id="needs_extra_info" name="needs_extra_info" value="1" {{ old('needs_extra_info', $other->needs_extra_info) ? 'checked' : '' }}>
  <label class="ml-2 block mt-0.5" for="needs_extra_info" >Has extra info</label>
</div>

<div class="my-2">
  <label for="prompt">Optional extra info prompt:</label>
  <div class="mt-1">
    <input class="w-full type="text" id="prompt" name="prompt" value="{{ old('prompt', $other->prompt) }}">
  </div>
</div>
