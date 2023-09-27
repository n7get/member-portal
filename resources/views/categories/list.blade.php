<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="{{ ucfirst($access) }} Resources" />
  </x-slot>

  <div class="page">
    <div class="max-w-4xl container">
      <x-success />

      <div
        x-data="listData()"
        @add-category.window="addCategory()"
        @save-category.window="saveCategory()"
        @save-file.window="saveFile()"
        class="panel"
      >
        <div class="border-b-2 sm:border-none hidden sm:flex gap-2">
          <div class="w-4/5 flex gap-2">
            <div class="font-bold w-1/3 underline">Name</div>
            <div class="font-bold w-2/3 underline">Description</div>
          </div>
          <div class="w-1/5"></div>
        </div>
        <x-editable-list-form submitRoute="{{ route('categories.save') }}" emit="add-category" add="Add Category">
          <input type="hidden" name="access" value="{{ $access }}" />
          <template x-for="(category, category_index) in categories" :key="category.key">
            <div>
              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 font-ex hover:bg-gray-100"">
                <input :name="formId(category_index)" type="hidden" x-model="category.id" />
                <input :name="formName(category_index)" type="hidden" x-model="category.name" />
                <input :name="formDescription(category_index)" type="hidden" x-model="category.description" />

                <div class="w-4/5 sm:w-3/4 sm:flex gap-2">
                    <div class="w-1/3 sm:truncate font-extrabold sm:font-normal" x-text="category.name"></div>
                    <div class="w-2/3 text-sm sm:text-lg sm:truncate" x-text="category.description"></div>
                </div>

                <div class="w-1/5 sm:w-1/4 flex gap-2 justify-end">
                  <div @click="moveCategoryUp(category_index)" class="cursor-pointer"><x-icons.up-arrow /></div>
                  <div @click="moveCategoryDown(category_index)" class="cursor-pointer"><x-icons.down-arrow /></div>
                  <div @click="editCategory(category_index)" class="cursor-pointer"><x-icons.edit /></div>
                  <div @click="addFile(category_index)" class="cursor-pointer"><x-icons.plus /></div>
                  <div @click="descroryCategory(category_index)" class="cursor-pointer"><x-icons.delete /></div>
                </div>
              </div>
              <template x-for="(file, file_index) in category.files" :key="file.key">
                  <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex gap-2 bg-grey-400 hover:bg-gray-100"">
                    <input type="hidden" :name="formFile(category_index, file_index, file.id)" x-model="file_index" />

                    <div class="w-4/5 sm:w-3/4 sm:flex gap-2">
                      <div class="w-1/3 sm:truncate font-extrabold sm:font-normal" x-text="file.name"></div>
                      <div class="w-2/3 sm:truncate text-sm sm:text-lg" x-text="file.description"></div>
                    </div>

                    <div class="w-1/5 sm:w-1/4 flex gap-2 justify-end">
                      <div @click="moveFileUp(category_index, file_index)" class="cursor-pointer"><x-icons.up-arrow /></div>
                      <div @click="moveFiledown(category_index, file_index)" class="cursor-pointer"><x-icons.down-arrow /></div>
                      <div @click="editFile(category_index, file_index)" class="cursor-pointer"><x-icons.edit /></div>
                      <div @click="destoryFile(category_index, file_index)" class="cursor-pointer"><x-icons.delete /></div>
                    </div>
                  </div>
              </template>
            </div>
          </template>
        </x-editable-list-form>
      </div>
    </div>
  </div>

  @include('categories.partials.category-modal')
  @include('categories.partials.file-modal')

  @push('scripts')
    <script>
      function listData() {
        const categories = @json($categories);
        
        categories.forEach(category => {
          category.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
          
          category.files.forEach(file => {
            file.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
          });
        });

        return {
          categories: categories,

          formId(category_index) {
            return `category[${category_index}][id]`;
          },
          formName(category_index) {
            return `category[${category_index}][name]`;
          },
          formDescription(category_index) {
            return `category[${category_index}][description]`;
          },
          formFile(category_index, file_index, id) {
            return `file[${category_index}][${id}][order]`;
          },

          moveCategoryUp(category_index) {
            if (category_index > 0) {
              this.categories.splice(category_index - 1, 0, this.categories.splice(category_index, 1)[0]);
            }
          },
          moveCategoryDown(category_index) {
            if (category_index < this.categories.length - 1) {
              this.categories.splice(category_index + 1, 0, this.categories.splice(category_index, 1)[0]);
            }
          },
          editCategory(category_index) {
            this.$dispatch('edit-category', {
              category_index: category_index,
              category: this.categories[category_index],
            });
          },

          addCategory() {
            this.$dispatch('edit-category', {
              category_index: this.categories.length,
              category: {
                id: 0,
                name: '',
                description: '',
              },
            });
          },
          saveCategory() {
            const category_index = this.$event.detail.category_index;
            const category = this.$event.detail.category;
            category.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

            this.categories[category_index] = category;
          },
          descroryCategory(category_index) {
            this.categories.splice(category_index, 1);
          },

          moveFileUp(category_index, file_index) {
            const category = this.categories[category_index];

            if (file_index > 0) {
              category.files.splice(file_index - 1, 0, category.files.splice(file_index, 1)[0]);
            }
          },
          moveFiledown(category_index, file_index) {
            const category = this.categories[category_index];

            if (file_index < category.files.length - 1) {
              category.files.splice(file_index + 1, 0, category.files.splice(file_index, 1)[0]);
            }
          },

          editFile(category_index, file_index) {
            const category = this.categories[category_index];

            this.$dispatch('edit-file', {
              category_index: category_index,
              file_index: file_index,
              file: category.files[file_index],
            });
          },
          destoryFile(category_index, file_index) {
            this.categories[category_index].files.splice(file_index, 1);
          },

          addFile(category_index) {
            this.$dispatch('edit-file', {
              category_index: category_index,
              file_index: this.categories[category_index].files.length,
              file: {
                id: 0,
                name: '',
              },
            });
          },
          saveFile() {
            const category_index = this.$event.detail.category_index;
            const category = this.categories[category_index];

            const file_index = this.$event.detail.file_index;
            const file = this.$event.detail.file;
            file.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

            category.files[file_index] = file;
          },
        };
      }
    </script>
  @endpush
</x-app-layout>


