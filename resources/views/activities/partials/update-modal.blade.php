<x-modal name="update-modal" focusable>
  <div x-data="updateModelData()" @open-log-edit.window="openLogEdit()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">
      Edit activity log
    </h2>

    <!-- duration -->
    <div class="mt-3">
      <x-input-label for="duration">Attended:</x-input-label>
      <x-text-input id="duration" class="block mt-1 w-full" type="text" duration="duration" x-model="duration" autofocus required />
      <div class="text-sm text-red-600" x-show="durationError" x-text="durationError"></div>
    </div>
    
    <!-- mode -->
    <div class="mt-3">
      <x-input-label for="mode">Mode</x-input-label>
      <select id="mode" class="block mt-1 w-full" name="mode" x-model="mode">
        <option value="">Choose One</option>
        <template x-for="m in modes">
          <option :value="m" x-bind:selected="mode == m" x-text="m"></option>
        </template>
      </select>
    </div>
    
    <!-- notes -->
    <div class="mt-3">
      <x-input-label for="notes">Notes:</x-input-label>
      <textarea name="notes" id="notes" class="w-1/2" x-model="notes"></textarea>
    </div>

    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button @click="saveLog()">Save</x-primary-button>
        <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function updateModelData() {
      return {
        index: -1,
        attended: '',
        duration: '',
        mode: '',
        notes: '',
        modes: modes,
        durationError: null,

        openLogEdit() {
          this.index = event.detail.index;
          this.duration = event.detail.duration;
          this.mode = event.detail.mode;
          this.notes = event.detail.notes;

          this.$dispatch('open-modal', 'update-modal');
        },

        validate() {
          let hasError = false;
          this.durationError = null;

          const durationRegex = /^(?:\d+|\d+:\d{1,2}|\d+:\d{1,2}:\d{1,2})$/;
          if (!durationRegex.test(this.duration)) {
            this.durationError = 'Duration must be in the format of MM or HH:MM or DD:MM:SS';
            hasError = true;
          }

          return !hasError;
        },

        saveLog() {
          if (!this.validate()) {
            return;
          }

          this.$dispatch('close');

          this.$dispatch('update-log', {
            index: this.index,
            duration: this.duration,
            mode: this.mode,
            notes: this.notes,
          });
        },
      }
    }
  </script>
@endpush
