<!-- Name -->
<div class="mt-3">
  <x-input-label for="name">Name:</x-input-label>
  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $file->name)" autofocus required />
  <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Description -->
<div class="mt-3">
  <x-input-label for="description">Description:</x-input-label>
  <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $file->description) }}</textarea>
  <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<!-- Version -->
<div class="mt-3">
  <x-input-label for="version">Version:</x-input-label>
  <x-text-input id="version" class="block mt-1 w-full" type="text" name="version" :value="old('version', $file->version)" required />
  <x-input-error :messages="$errors->get('version')" class="mt-2" />
</div>

<!-- Access -->
<div class="mt-3">
  <x-input-label for="access">Access:</x-input-label>
  <select id="access" class="block mt-1 w-full" name="access">
    @foreach($access_levels as $access_level)
      <option value="{{ $access_level }}" @selected(old('access', $file->access) == $access_level)>{{ $access_level }}</option>
    @endforeach
  </select>
  <x-input-error :messages="$errors->get('access')" class="mt-2" />
</div>

<!-- File Upload -->
<div class="mt-3">
  <x-input-label for="data">File Upload:</x-input-label>
  <input type="file" id="data" class="block mt-1 w-full" name="data"></input>
  <x-input-error :messages="$errors->get('data')" class="mt-2" />
</div>
