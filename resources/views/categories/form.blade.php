<!-- Name -->
<div class="mt-3">
  <x-input-label for="name">Name</x-input-label>
  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name)" autofocus required />
  <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Description -->
<div class="mt-3">
  <x-input-label for="description">Description</x-input-label>
  <textarea id="description" class="block mt-1 w-full" name="description"required>{{ old('description', $category->description) }}</textarea>
  <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<!-- Access -->
<div class="mt-3">
  <x-input-label for="access">Access</x-input-label>
  <select id="access" class="block mt-1 w-full" name="access">
    @foreach($access_levels as $access_level)
      <option value="{{ $access_level }}" {{ old('access', $category->access) == $access_level ? 'selected' : '' }}>{{ $access_level }}</option>
    @endforeach
  </select>
  <x-input-error :messages="$errors->get('access')" class="mt-2" />
</div>

<!-- Order -->
<div class="mt-3">
  <x-input-label for="order">Order:</x-input-label>
  <x-text-input id="order" class="block mt-1 w-20" type="number" name="order" :value="old('order', $category->order)" required />
  <x-input-error :messages="$errors->get('order')" class="mt-2" />
</div>
