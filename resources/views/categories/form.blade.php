<x-error-box />

<div>
  <label for="name">Name</label>
  <div class="mt--1">
    <input type="text" class="w-full" id="name" name="name" value="{{ old('name', $category->name) }}" required>
  </div>
</div>

<div class="mt-4">
  <label for="description">Description</label>
  <div class="mt--1">
    <textarea class="w-full" id="description" name="description" required>{{ old('description', $category->description) }}</textarea>
  </div>
</div>

<div class="mt-2">
  <label for="access">Access</label>
  <div class="mt--1">
    <select name="access" id="access">
      @foreach($access_levels as $access_level)
        <option value="{{ $access_level }}" {{ old('access', $category->access) == $access_level ? 'selected' : '' }}>{{ $access_level }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="mt-3">
  <label for="order">Order:</label>
  <div class="mt-1">
    <input class="w-16 type="number" id="order" name="order" value="{{ old('order', $category->order) }}" required>
  </div>
</div>
