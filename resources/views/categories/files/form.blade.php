<div class="mt-2">
  <x-input-label for="file_id">File</x-input-label>
  <div class="mt--1">
    @if ($file->id != null)
      {{ $file->name . ' ' . $file->version . ' (' . $file->access . ')' }}
    @else
      <select name="file_id" id="file_id">
        <option value="">Select a file</option>
        @foreach($files as $f)
          <option value="{{ $f->id }}" @selected(old('file_id', $file->id) == $f->id)>
            {{ $f->name . ' ' . $f->version . ' (' . $f->access . ')' }}
          </option>
        @endforeach
      </select>
    @endif
  </div>
  <x-input-error :messages="$errors->get('file_id')" class="mt-2" />
</div>

<!-- Order -->
<div class="mt-3">
  <x-input-label for="order">Order:</x-input-label>
  <x-text-input id="order" class="block mt-1 w-20" type="number" name="order" :value="old('order', $order)" required />
  <x-input-error :messages="$errors->get('order')" class="mt-2" />
</div>
