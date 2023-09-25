<x-modal name="confirm-delete-modal" focusable>
  <div x-data="modalData()" class="panel">
    <div class="my-3 mb-9">
        Are you sure you want to delete this <span x-text="type"></span>?
    </div>
    <div @open-delete-modal.window="handleOpen()">
      <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex gap-3 justify-end pt-3">
          <div>
            <x-primary-button type="submit">Confirm Delete</x-primary-button>
          </div>
          <div @click="$dispatch('close')">
            <x-secondary-button>Cancel</x-secondary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-modal>

@push('scripts')
  <script>
    function modalData() {
      return {
        type: 'unknown',
        url: '',

        openModal: function() {
          const parent = this.$event.target.closest('div');

          this.$dispatch('open-delete-modal', {
            url: parent.getAttribute('data-url'),
            type: parent.getAttribute('data-type'),
          });
        },

        handleOpen() {
          this.type = this.$event.detail.type;
          
          document.getElementById('delete-form').action = this.$event.detail.url;

          this.$dispatch('open-modal', 'confirm-delete-modal');
        },
      };
    }
  </script>
@endpush
