@props([
  'submitRoute',
  'itemList',
])

<div class="page">
  <div class="max-w-xl container">
    <x-success />

    <div
      x-data="listData()"
      @add-item.window="addItem()"
      @save-item.window="saveItem()"
      class="panel"
    >
      <x-editable-list-form submitRoute="{{ $submitRoute }}" emit="add-item" add="Add">
        <div>
          <template x-for="(item, index) in items" :key="item.key">
            <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex hover:bg-gray-100">
              <input :name="formInput(index, 'id')" type="hidden" x-model="item.id" />
              <input :name="formInput(index, 'description')" type="hidden" x-model="item.description" />
              <input :name="formInput(index, 'order')" type="hidden" x-model="index">

              <div class="w-8/12 sm:truncate font-extrabold sm:font-normal" x-text="item.description"></div>

              <div class="w-4/12 flex gap-2 justify-end">
                <div @click="moveItemUp(index)" class="cursor-pointer"><x-icons.up-arrow /></div>
                <div @click="moveItemDown(index)" class="cursor-pointer"><x-icons.down-arrow /></div>
                <div @click="editItem(index)" class="cursor-pointer"><x-icons.edit /></div>
                <div @click="destroyItem(index)" class="cursor-pointer"><x-icons.delete /></div>
              </div>
            </div>
          </template>
        </div>
      </x-editable-list-form>
    </div>
  </div>
</div>

<x-modal name="add-modal" focusable>
  <div x-data="modelData()" @open-add-modal.window="openAddModal()" class="panel">
    <h2 class="text-lg font-medium text-gray-900">Add Capability</h2>

    <div class="mt-3">
      <x-input-label for="description">Description:</x-input-label>
      <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" x-model="description" autofocus required />
    </div>

    <div class="flex gap-3 justify-end pt-6">
        <x-primary-button @click="save()">Save</x-primary-button>
        <x-secondary-button @click="$dispatch('close')">Cancel</x-secondary-button>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function listData() {
      const items = {!! $itemList !!};
      
      items.forEach((item, index) => {
        item.index = index;
        item.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
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
          this.$dispatch('open-add-modal', {
            index: index,
            item: this.item,
          });
        },

        addItem() {
          this.$dispatch('open-add-modal', {
            index: this.items.length,
            item: {
              id: 0,
              description: '',
            },
          });
        },
        saveItem() {
          const item = this.$event.detail.item;
          item.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

          if (item.index === -1) {
            this.items.unshift(item);
          } else {
            this.items[item.index] = item;
          }
        },
        destroyItem(index) {
          this.items.splice(index, 1);
        },
      };
    }

    function modelData() {
      return {
        index: -1,
        id: null,
        description: null,

        openAddModal() {
          this.index = this.$event.detail.index;
          
          const item = this.$event.detail.item;
          this.id = item.id;
          this.description = item.description;

          this.$dispatch('open-modal', 'add-modal');
        },

        save() {
          this.$dispatch('close');
          this.$dispatch('save-item', {
            index: this.index,
            item: {
              index: this.index,
              id: this.id,
              description: this.description,
            },
          });
        },
      };
    }
  </script>
@endpush
