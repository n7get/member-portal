<x-error-box />

<div>
  <div>
    <div>
      <label for="description">Description</label>
        <div class="mt-1">
          <input type="text" id="description" name="description" value="{{ old('description', $capability->description) }}" required>
        </div>
    </div>
  </div>

  <div>
    <div>
      <label for="order">Order</label>
        <div class="mt-1">
          <input type="number" id="order" name="order" value="{{ old('order', $capability->order) }}" required>
        </div>
    </div>
  </div>
</div>
