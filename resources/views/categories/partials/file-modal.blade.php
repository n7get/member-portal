<x-modal name="file-modal" focusable>
  <div x-data="fileModelData()" @edit-file.window="openFileModal()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">Add file to resource category</h2>

    <div class="mt-3">
      <x-input-label for="id">File Name</x-input-label>
      <select id="id" class="block mt-1 w-full" name="id" x-model="id">
        <option value="">Choose One</option>
        <template x-for="file in all_files">
          <option :value="file.id" x-bind:selected="name == file.name" x-text="file.name"></option>
        </template>
      </select>
    </div>

    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button @click="saveFile()">Save</x-primary-button>
        <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function fileModelData() {
      const all_files = @json($all_files);
      
      return {
        all_files: all_files,
        category_index: -1,
        file_index: -1,
        id: null,
        name: null,

        openFileModal() {
          this.category_index = this.$event.detail.category_index;
          this.file_index = this.$event.detail.file_index;
          const file = this.$event.detail.file;
          
          this.id = file.id;
          this.name = file.name,

          this.$dispatch('open-modal', 'file-modal');
        },

        saveFile() {
          if (! this.id) {
            return;
          }

          const file = this.all_files.find(file => file.id == this.id);

          this.$dispatch('close');
          this.$dispatch('save-file', {
            category_index: this.category_index,
            file_index: this.file_index,
            file: file,
          });
        },
      }
    }
  </script>
@endpush
