<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $activity->name }}" right-nav-route="activities.edit" right-nav-id="{{ $activity->id }}" />
  </x-slot>

  <div class="page">
    <div class="max-w-3xl container">
      <x-success />

      <div
        x-data="listData()"
        @update-log.window="updateLog()"
        @add-logs.window="addLogs()"
        @add-to-activity.window="updateActivity()"
        class="panel"
      >
        <div class="flex gap-2">
          <div>Description:</div>
          <div>{{ $activity->description }}</div>
        </div>
        <div class="flex gap-2">
          <div>Type:</div>
          <div>{{ $activity->activityType->description }}</div>
        </div>
        <div class="flex gap-2">
          <div>Date:</div>
          <div>{{ $activity->date }}</div>
        </div>
        <div class="flex gap-2">
          <div>Duration:</div>
          <div>{{ $activity->duration }}</div>
        </div>
        <div class="flex gap-2">
          <div>Location:</div>
          <div>{{ $activity->location }}</div>
        </div>
        <div class="flex gap-2">
          <div>Notes:</div>
          <div>{{ $activity->notes }}</div>
        </div>
        <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
          <div class="w-11/12 flex gap-2">
            <div class="w-2/12 font-bold underline">Callsign</div>
            <div class="w-1/12 font-bold underline">Att</div>
            <div class="w-1/12 font-bold underline">Dur</div>
            <div class="w-3/12 font-bold underline">Mode</div>
            <div class="w-5/12 font-bold underline">Notes</div>
          </div>
          <div class="w-1/12"></div>
        </div>
        <x-editable-list-form submitRoute="{{ route('activities.save', $activity->id) }}" emit="add-logs" add="Add">
          <template x-for="(log, index) in logs" :key="log.key">
            <div>
              <input :name="fieldName(index, 'id')" type="hidden" x-model="log.id" />
              <input :name="fieldName(index, 'member')" type="hidden" x-model="log.member" />
              <input :name="fieldName(index, 'attended')" type="hidden" x-model="log.attended" />
              <input :name="fieldName(index, 'duration')" type="hidden" x-model="log.duration" />
              <input :name="fieldName(index, 'mode')" type="hidden" x-model="log.mode" />
              <input :name="fieldName(index, 'notes')" type="hidden" x-model="log.notes" />

              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 font-ex hover:bg-gray-100"">
                <div class="w-11/12 sm:flex gap-2">
                  <div class="w-2/12" x-text="log.member"></div>
                  <div class="w-1/12">
                    <span x-show="log.attended">
                      <x-icons.check />
                    </span>
                  </div>
                  <div class="w-1/12" x-text="log.duration"></div>
                  <div class="w-3/12 truncate" x-text="log.mode"></div>
                  <div class="w-5/12 truncate" x-text="log.notes"></div>
                </div>

                <div class="w-1/12 flex gap-2 justify-end">
                  <div @click="editLog(index)" class="cursor-pointer"><x-icons.edit /></div>
                  <div @click="descroryLog(index)" class="cursor-pointer"><x-icons.delete /></div>
                </div>
              </div>
            </div>
          </template>
        </x-editable-list-form>
      </div>
    </div>
  </div>

  @include('activities.partials.edit-modal')
  @include('activities.partials.add-modal')

  @push('scripts')
    <script>
      const members = @json($members);
      const modes = @json($modes);

      validate = function() {
        let hasError = false;
        this.durationError = null;

        const durationRegex = /^(?:\d+|\d+:\d{1,2}|\d+:\d{1,2}:\d{1,2})$/;
        if (!durationRegex.test(this.duration)) {
          this.durationError = 'Duration must be in the format of MM or HH:MM or DD:MM:SS';
          hasError = true;
        }

        return !hasError;
      }

      function makeKey() {
        return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
      }

      function listData() {
        const logs = @json($logs);

        logs.forEach(log => {
          log.key = makeKey();
        });
        
        return {
          logs: logs,

          fieldName(index, field) {
            return `log[${index}][${field}]`;
          },

          sortLogs() {
            this.logs.sort((a, b) => {
              if (a.member < b.member) {
                return -1;
              }
              if (a.member > b.member) {
                return 1;
              }
              if (a.mode < b.mode) {
                return -1;
              }
              if (a.mode > b.mode) {
                return 1;
              }
              return 0;
            });
          },

          addLogs() {
            this.$dispatch('open-add-modal');
          },

          editLog(index) {
            this.$dispatch('edit-log', {
              index: index,
              member: this.logs[index].member,
              attended: this.logs[index].attended,
              duration: this.logs[index].duration,
              mode: this.logs[index].mode,
              notes: this.logs[index].notes,
            });
          },
          descroryLog(index) {
            this.logs.splice(index, 1);
          },

          updateLog() {
            const index = this.$event.detail.index;
            const log = this.logs[index];

            log.attended = this.$event.detail.attended;
            log.duration = this.$event.detail.duration;
            log.mode = this.$event.detail.mode;
            log.notes = this.$event.detail.notes;
          },

          updateActivity() {
            const members = this.$event.detail.members;
            const duration = this.$event.detail.duration;
            const mode = this.$event.detail.mode;

            const logMap = new Map();
            this.logs.forEach(log => {
              logMap.set(log.member + '.' + log.mode, log);
            });

            members.forEach(member => {
              const key = member + '.' + mode;
              if (logMap.has(key)) {
                const log = logMap.get(key);

                log.key = makeKey();
                log.attended = 1;
                if (log.duration <= duration) {
                  log.duration = duration;
                }
              } else {
                const log = {
                  id: 0,
                  key: makeKey(),
                  member: member,
                  attended: 1,
                  duration: duration,
                  mode: mode,
                  notes: '',
                };
                logMap.set(key, log);
              }
            });

            this.logs = Array.from(logMap.values());
            this.sortLogs();
          },
        };
      }
    </script>
  @endpush
</x-app-layout>
