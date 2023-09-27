<x-modal name="category-modal" focusable>
  <div x-data="categoryModelData()" @edit-category.window="openCategoryModel()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">Add new resource category</h2>

    <div class="mt-3">
      <x-input-label for="name">Description:</x-input-label>
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" x-model="name" autofocus required />
    </div>

    <div class="mt-3">
      <x-input-label for="description">Description:</x-input-label>
      <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" x-model="description"
        autofocus required />
    </div>

    <div class="flex gap-3 justify-end pt-6">
      <x-primary-button @click="saveCategory()">Save</x-primary-button>
      <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function categoryModelData() {
      return {
        category_index: -1,
        id: null,
        name: null,
        description: null,

        openCategoryModel() {
          this.category_index = this.$event.detail.category_index;
          const category = this.$event.detail.category;

          this.id = category.id;
          this.name = category.name,
          this.description = category.description,

          this.$dispatch('open-modal', 'category-modal');
        },

        saveCategory() {
          if (! this.name || ! this.description) {
            return;
          }

          this.$dispatch('close');
          this.$dispatch('save-category', {
            category_index: this.category_index,
            category: {
              id: this.id,
              name: this.name,
              description: this.description,
              files: [],
            },
          });
        },
      }
    }
  </script>
@endpush
