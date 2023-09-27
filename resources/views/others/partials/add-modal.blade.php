<x-modal name="add-modal" focusable>
  <div x-data="modelData()" @edit-item.window="edit()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">Add Other Skills And Equipment</h2>

    <div class="mt-3">
      <x-input-label for="description">Description:</x-input-label>
      <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" x-model="description" autofocus required />
    </div>

    <div class="block mt-4">
      <label for="needs_extra_info" class="inline-flex gap-2 items-center">
        <input id="needs_extra_info" name="needs_extra_info" type="checkbox" x-model="needs_extra_info" :checked="needs_extra_info" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1">
        <span class="text-sm text-gray-600">Has extra info</span>
      </label>
    </div>

    <div class="mt-3">
      <x-input-label for="prompt">Optional extra info prompt:</x-input-label>
      <x-text-input id="prompt" class="block mt-1 w-full" type="text" name="prompt" x-model="prompt"  />
    </div>

    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button @click="save()">Save</x-primary-button>
        <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>

    function modelData() {
      return {
        index: -1,
        id: null,
        description: null,
        prompt: null,
        needs_extra_info: null,

        edit() {
          this.index = this.$event.detail.index;

          const item = this.$event.detail.item;
          this.id = item.id;
          this.description = item.description;
          this.prompt = item.prompt;
          this.needs_extra_info = item.needs_extra_info;

          this.$dispatch('open-modal', 'add-modal');
        },

        save() {
          this.$dispatch('close');
          this.$dispatch('save-item', {
            index: this.index,
            item: {
              id: this.id,
              description: this.description,
              prompt: this.prompt,
              needs_extra_info: this.needs_extra_info ? 1 : 0,
            },
          });
        },
      };
    }
  </script>
@endpush
