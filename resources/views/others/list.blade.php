<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Other skills & equipment" />
  </x-slot>

  <div class="page">
    <div class="max-w-4xl container">
      <x-success />

      <div
        x-data="listData()"
        @add-item.window="addItem()"
        @save-item.window="saveItem()"
        class="panel"
      >
        <div class="border-b-2 sm:border-none hidden sm:flex">
          <div class="basis-4/5 sm:basis-11/12 flex gap-2">
            <div class="font-bold basis-6/12 underline">Description</div>
            <div class="font-bold basis-1/12 text-center underline">Extra</div>
            <div class="font-bold basis-4/12 underline">Prompt</div>
          </div>
          <div class="basis-1/5 sm:basis-2/12"></div>
        </div>
        <x-editable-list-form submitRoute="{{ route('others.save') }}">
          <div>
            <template x-for="(item, index) in items" :key="item.key">
              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex hover:bg-gray-300">
                <input :name="formInput(index, 'id')" type="hidden" x-model="item.id" />
                <input :name="formInput(index, 'description')" type="hidden" x-model="item.description" />
                <input :name="formInput(index, 'needs_extra_info')" type="hidden" x-model="item.needs_extra_info" />
                <input :name="formInput(index, 'prompt')" type="hidden" x-model="item.prompt" />
                <input :name="formInput(index, 'order')" type="hidden" x-model="index">

                <div class="basis-4/5 sm:basis-11/12 sm:flex gap-2">
                  <div class="basis-6/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap font-extrabold sm:font-normal" x-text="item.description"></div>
                  <div class="basis-1/12 sm:text-center">
                    <span class="sm:hidden text-sm">Has extra input</span>
                    <svg x-show="item.needs_extra_info" class="hidden sm:inline w-5 mt-1" class="inline w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                  </div>
                  <div class="basis-4/12 sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                    <span class="sm:hidden inline-block text-sm">Prompt:</span>
                    <span class="text-sm sm:text-lg" x-text="item.prompt"></span>
                  </div>
                </div>

                <div class="basis-1/5 sm:basis-2/12 flex gap-2 justify-end items-center">
                  <div @click="moveItemUp(index)" class="cursor-pointer"><x-icons.up-arrow /></div>
                  <div @click="moveItemDown(index)" class="cursor-pointer"><x-icons.down-arrow /></div>
                  <div @click="editItem(index)" class="cursor-pointer"><x-icons.edit /></div>
                  <div @click="destroyItem(index)" class="delete-other cursor-pointer"><x-icons.delete /></div>
                </div>
              </div>
            </template>
          </div>
        </x-editable-list-form>
      </div>
    </div>
  </div>

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
</x-app-layout>

@push('scripts')
  <script>
    function listData() {
      const items = {!! $others !!};
      
      items.forEach((item, index) => {
        item.index = index;
        item.key = Math.random();
      });

      return {
        items: items,

        formInput(index, field) {
          return `formInput[${index}][${field}]`;
        },

        moveItemUp(index) {
          if (index > 0) {
            this.items.splice(index - 1, 0, this.items.splice(index, 1)[0]);
          }
        },
        moveItemDown(index) {
          if (index < this.items.length - 1) {
            this.items.splice(index + 1, 0, this.items.splice(index, 1)[0]);
          }
        },

        editItem(index) {
          this.$dispatch('edit-item', {
            index: index,
            item: this.items[index],
          });
        },

        addItem() {
          this.$dispatch('edit-item', {
            index: this.items.length,
            item: {
              id: 0,
              description: '',
              prompt: '',
              needs_extra_info: 0,
            },
          });
        },
        saveItem() {
          const index = this.$event.detail.index;
          const item = this.$event.detail.item;
          item.key = Math.random();

          this.items[index] = item;
        },
        destroyItem(index) {
          this.items.splice(index, 1);
        },

        openAddModal(item) {
          console.log('item: ', item);
          this.$dispatch('open-modal', 'add-modal', item);
        },
      };
    }

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
