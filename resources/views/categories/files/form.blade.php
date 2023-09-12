<x-error-box />

<div class="mt-2">
  <label for="file_id">File</label>
  <div class="mt--1">
    @if ($file->id != null)
      {{ $file->name . ' ' . $file->version . ' (' . $file->access . ')' }}
    @else
      <select name="file_id" id="file_id">
        <option value="">Select a file</option>
        @foreach($files as $f)
          <option value="{{ $f->id }}">
            {{ $f->name . ' ' . $f->version . ' (' . $f->access . ')' }}
          </option>
        @endforeach
      </select>
    @endif
  </div>
</div>

<div class="mt-3">
  <label for="order">Order:</label>
  <div class="mt-1">
    <input class="w-16 type="number" id="order" name="order" value="{{ old('order', $order) }}" required>
  </div>
</div>
