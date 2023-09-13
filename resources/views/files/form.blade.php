<x-error-box />

<div>
  <label for="name">Name</label>
  <div class="mt--1">
    <input type="text" class="w-full" id="name" name="name" value="{{ old('name', $file->name) }}" required>
  </div>
</div>

<div class="mt-4">
  <label for="description">Description</label>
  <div class="mt--1">
    <textarea class="w-full" id="description" name="description" required>{{ old('description', $file->description) }}</textarea>
  </div>
</div>

<div class="mt-2">
  <label for="version">Version</label>
  <div class="mt--1">
    <input type="text" class="w-full" id="version" name="version" value="{{ old('version', $file->version) }}" required>
  </div>
</div>

<div class="mt-2">
  <label for="access">Access</label>
  <div class="mt--1">
    <select name="access" id="access">
      @foreach($access_levels as $access_level)
        <option value="{{ $access_level }}" {{ old('access', $file->access) == $access_level ? 'selected' : '' }}>{{ $access_level }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="mt-3">
  <label for="data">File Upload</label>
  <div class="mt-1">
    <input type="file" id="data" name="data">
  </div>
</div>
