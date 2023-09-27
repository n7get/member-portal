<x-modal name="add-modal" focusable>
  <div x-data="addModelData()" @open-add-modal.window="openAddModal()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">Add activity logs</h2>

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
    
    <!-- raw input -->
    <div class="mt-3">
      <x-input-label for="rawInput">Callsings to log:</x-input-label>
      <textarea name="rawInput" id="rawInput" class="w-full" rows="10" x-model="rawInput"></textarea>
    </div>

    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button @click="parseInput()">Parse Input</x-primary-button>
          <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>

    <div x-show="membersFound.size > 0">
      <div class="mt-3">
        <x-input-label for="membersFound">Members found:</x-input-label>
        <div class="flex flex-wrap gap-2">
          <template x-for="member in Array.from(membersFound)">
            <div class="bg-gray-100 rounded p-2" x-text="member"></div>
          </template>
        </div>
      </div>

      <div class="flex gap-3 justify-end pt-6">
          <x-primary-button @click="addToActivity()">Add to activity</x-primary-button>
        <x-secondary-button @click="clear()">Clear</x-secondary-button>
      </div>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function addModelData() {
      return {
        duration: '{!! $activity->duration !!}',
        mode: '',
        members: members,
        modes: modes,
        rawInput: @json($rawInput),
        durationError: null,
        membersFound: new Set(),

        openAddModal() {
          this.clear();
          this.$dispatch('open-modal', 'add-modal');
        },

        extractCallsigns(text) {
          const regex = /\b[A-Z]{1,2}\d[A-Z]{1,3}\b/gi;

          return text.match(regex) || [];
        },

        validate: validate,
        parseInput() {
          const rawInput = this.rawInput.trim().toUpperCase();
          const callsigns = this.extractCallsigns(rawInput);
          
          if (callsigns.length === 0) {
            alert('No callsigns found in input');
            return;
          }

          callsigns.forEach(callsign => {
            if(this.members.includes(callsign)) {
              this.membersFound.add(callsign);
            }
          });
        },

        addToActivity() {
          if (!this.validate()) {
            return;
          }

          this.$dispatch('close');
          this.$dispatch('add-to-activity', {
            duration: this.duration,
            mode: this.mode,
            members: Array.from(this.membersFound),
          });
        },

        clear() {
          this.membersFound = new Set();
        },
      };
    }
  </script>
@endpush
