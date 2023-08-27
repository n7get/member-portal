<x-error-box />

<div class="mt-2">
  <label for="description">Description:</label>
  <div class="mt-1">
    <input class="w-full type="text" id="description" name="description" value="{{ old('description', $certification->description) }}" required>
  </div>
</div>

<div class="mt-3">
  <label for="order">Order:</label>
  <div class="mt-1">
    <input class="w-16 type="number" id="order" name="order" value="{{ old('order', $certification->order) }}" required>
  </div>
</div>
