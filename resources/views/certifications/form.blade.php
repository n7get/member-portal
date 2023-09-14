<!-- Description -->
<div class="mt-3">
  <x-input-label for="description">Description:</x-input-label>
  <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $certification->description)" autofocus required />
  <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<!-- Order -->
<div class="mt-3">
  <x-input-label for="order">Order:</x-input-label>
  <x-text-input id="order" class="block mt-1 w-20" type="number" name="order" :value="old('order', $certification->order)" required />
  <x-input-error :messages="$errors->get('order')" class="mt-2" />
</div>
