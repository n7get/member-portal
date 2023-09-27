<!-- Description -->
<div class="mt-3">
  <x-input-label for="description">Description:</x-input-label>
  <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $activity->description) }}</textarea>
  <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<!-- Activity Type -->
<div class="mt-3">
  <x-input-label for="activity_type">Activity Type:</x-input-label>
  <select id="activity_type" class="block mt-1 w-full" name="activity_type">
    @foreach($activity_types as $activity_type)
      <option value="{{ $activity_type->id }}" @selected(old('activity_type', $activity->activityType?->id) == $activity_type->id)>{{ $activity_type->description }}</option>
    @endforeach
  </select>
  <x-input-error :messages="$errors->get('activity_type')" class="mt-2" />
</div>

<!-- Date -->
<div class="mt-3">
  <x-input-label for="date">Date:</x-input-label>
  <x-text-input id="date" class="block mt-1 w-full" type="text" name="date" :value="old('date', $activity->date)" required placeholder="dd-mm-yy hh:mm" />
  <x-input-error :messages="$errors->get('date')" class="mt-2" />
</div>

<!-- Duration -->
<div class="mt-3">
  <x-input-label for="duration">Duration:</x-input-label>
  <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration', $activity->duration)" required placeholder="mm or hh:mm or dd:hh:nn" />
  <x-input-error :messages="$errors->get('duration')" class="mt-2" />
</div>

<!-- Location -->
<div class="mt-3">
  <x-input-label for="location">Location:</x-input-label>
  <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $activity->location)" required />
</div>

<!-- Notes -->
<div class="mt-3">
  <x-input-label for="notes">Notes:</x-input-label>
  <textarea id="notes" class="block mt-1 w-full" name="notes">{{ old('notes', $activity->notes) }}</textarea>
  <x-input-error :messages="$errors->get('notes')" class="mt-2" />
</div>
