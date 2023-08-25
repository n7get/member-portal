<x-error-box />

<div>
  <div>
    <div>
      <label for="description">Description</label>
        <div class="mt-1">
          <input type="text" id="description" name="description" value="{{ old('description', $other->description) }}" required>
        </div>
    </div>
  </div>

  <div>
    <div>
      <label for="order">Order</label>
        <div class="mt-1">
          <input type="number" id="order" name="order" value="{{ old('order', $other->order) }}" required>
        </div>
    </div>
  </div>
</div>

<div>
  <div>
      <div>
          <input type="hidden" name="data" value="0">
          <label for="data" >Has data field</label>
        <div class="mt-1">
              <input type="checkbox" id="data" name="data" value="1" {{ old('data', $other->data) ? 'checked' : '' }}>
        </div>
      </div>
  </div>
</div>

<div>
  <div>
    <div>
      <label for="prompt">Optional prompt</label>
        <div class="mt-1">
          <input type="text" id="prompt" name="prompt" value="{{ old('prompt', $other->prompt) }}">
        </div>
    </div>
  </div>
</div>
