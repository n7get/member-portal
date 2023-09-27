<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="File {{ $activity->name }}" />
  </x-slot>

  <div class="page">
    <div class="max-w-3xl container">
      <x-success />

      <div
        x-data="listData()"
        @update-log.window="update()"
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
            <div class="w-2/12 font-bold underline">Dur</div>
            <div class="w-4/12 font-bold underline">Mode</div>
            <div class="w-6/12 font-bold underline">Notes</div>
          </div>
          <div class="w-1/12"></div>
        </div>
        <x-editable-list-form submitRoute="{{ route('activities.update.logs', $activity->id) }}">
          <template x-for="(log, index) in logs" :key="log.key">
            <div>
              <input :name="fieldName(index, 'id')" type="hidden" x-model="log.id" />
              <input :name="fieldName(index, 'duration')" type="hidden" x-model="log.duration" />
              <input :name="fieldName(index, 'mode')" type="hidden" x-model="log.mode" />
              <input :name="fieldName(index, 'notes')" type="hidden" x-model="log.notes" />

              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 font-ex hover:bg-gray-100"">
                <div class="w-11/12 sm:flex gap-2">
                  <div class="w-2/12" x-text="log.duration"></div>
                  <div class="w-4/12 truncate" x-text="log.mode"></div>
                  <div class="w-6/12 truncate" x-text="log.notes"></div>
                </div>

                <div class="w-1/12 flex gap-2 justify-end">
                  <div @click="emitLogUpdate(index)" class="cursor-pointer"><x-icons.edit /></div>
                  <div @click="descroryLog(index)" class="cursor-pointer"><x-icons.delete /></div>
                </div>
              </div>
            </div>
          </template>
        </x-editable-list-form>
      </div>
    </div>
  </div>

  @include('activities.partials.update-modal')

  @push('scripts')
    <script>
      const modes = @json($modes);

      function makeKey() {
        return;
      }

      function listData() {
        const logs = @json($logs);

        logs.forEach(log => {
          log.key = makeKey();
        });
        
        return {
          duration: {{ $activity->duration }},
          logs: logs,

          fieldName(index, field) {
            return `log[${index}][${field}]`;
          },

          emitLogUpdate(index) {
            this.$dispatch('open-log-edit', {
              index: index,
              duration: this.logs[index].duration || this.duration,
              mode: this.logs[index].mode,
              notes: this.logs[index].notes,
            });
          },
          descroryLog(index) {
            this.logs.splice(index, 1);
          },

          update() {
            const index = this.$event.detail.index;
            const log = this.logs[index];

            log.key = makeKey();
            log.duration = this.$event.detail.duration;
            log.mode = this.$event.detail.mode;
            log.notes = this.$event.detail.notes;
          },
        };
      }
    </script>
  @endpush
</x-app-layout>
