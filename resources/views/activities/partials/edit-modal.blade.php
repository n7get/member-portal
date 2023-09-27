<x-modal name="edit-modal" focusable>
  <div x-data="editModelData()" @edit-log.window="openEditModal()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">
      Edit activity log for <span x-text="member"></span>
    </h2>

    <!-- attended -->
    <div class="block mt-4">
      <label for="attended" class="inline-flex gap-2 items-center">
        <input id="attended" name="attended" type="checkbox" x-model="attended" :checked="attended" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1">
        <span class="text-sm text-gray-600">Attended activity</span>
      </label>
    </div>

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
    function editModelData() {
      return {
        index: -1,
        member: '',
        attended: '',
        duration: '',
        mode: '',
        notes: '',
        members: members,
        modes: modes,
        durationError: null,

        openEditModal() {
          this.index = event.detail.index;
          this.member = event.detail.member;
          this.attended = event.detail.attended;
          this.duration = event.detail.duration;
          this.mode = event.detail.mode;
          this.notes = event.detail.notes;

          this.$dispatch('open-modal', 'edit-modal');
        },

        validate: validate,
        saveLog() {
          if (!this.validate()) {
            return;
          }

          this.$dispatch('close');

          this.$dispatch('update-log', {
            index: this.index,
            member: this.member,
            attended: this.attended ? 1 : 0,
            duration: this.duration,
            mode: this.mode,
            notes: this.notes,
          });
        },
      }
    }
  </script>
@endpush
