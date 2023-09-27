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
          <div class="w-4/5 sm:w-11/12 flex gap-2">
            <div class="w-6/12 font-bold underline">Description</div>
            <div class="w-1/12 font-bold text-center underline">Extra</div>
            <div class="w-4/12 font-bold underline">Prompt</div>
          </div>
          <div class="w-1/5 sm:w-2/12"></div>
        </div>
        <x-editable-list-form submitRoute="{{ route('others.save') }}" emit="add-item" add="add">
          <div>
            <template x-for="(item, index) in items" :key="item.key">
              <div class="border-b-2 sm:border-none mt-2 sm:mt-0 pb-2 sm:pb-0 flex hover:bg-gray-100">
                <input :name="formInput(index, 'id')" type="hidden" x-model="item.id" />
                <input :name="formInput(index, 'description')" type="hidden" x-model="item.description" />
                <input :name="formInput(index, 'needs_extra_info')" type="hidden" x-model="item.needs_extra_info" />
                <input :name="formInput(index, 'prompt')" type="hidden" x-model="item.prompt" />
                <input :name="formInput(index, 'order')" type="hidden" x-model="index">

                <div class="w-4/5 sm:w-11/12 sm:flex gap-2">
                  <div class="w-6/12 sm:truncate font-extrabold sm:font-normal" x-text="item.description"></div>
                  <div class="w-1/12 sm:text-center">
                    <span class="sm:hidden text-sm">Has extra input</span>
                    <svg x-show="item.needs_extra_info" class="hidden sm:inline w-5 mt-1" class="inline w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                  </div>
                  <div class="w-4/12 sm:truncate">
                    <span class="sm:hidden inline-block text-sm">Prompt:</span>
                    <span class="text-sm sm:text-lg" x-text="item.prompt"></span>
                  </div>
                </div>

                <div class="w-1/5 sm:w-2/12 flex gap-2 justify-end items-center">
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

  @include('others.partials.add-modal')

@push('scripts')
  <script>
    function listData() {
      const items = @json($others);
      
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
          item.key = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

          this.items[index] = item;
        },
        destroyItem(index) {
          this.items.splice(index, 1);
        },
      };
    }
  </script>
@endpush
</x-app-layout>
