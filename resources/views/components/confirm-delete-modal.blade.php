@props([
  'modalId' => 'confirm-delete-modal',
  'formId' => 'confirm-delete-modal-form',
  'openModalButtonClass' => 'confirm-delete-modal-open-button',
  'urlAttribute' => 'data-url',
  'type',
])

<x-modal-multi-line
    modal-id="{{ $modalId }}" 
    form-id="{{ $formId }}"
    openModalButtonClass="{{ $openModalButtonClass }}"
    url-attribute="{{ $urlAttribute }}"
    close-button-class="close-button"
  >
  <div>
    <div class="border-t border-b my-3 py-3">
        Are you sure you want to delete this {{ $type }}?
    </div>
    <div>
      <form id="{{ $formId }}" action="" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex flex-row justify-end pt-3">
          <div class="submit-button">
            <x-primary-button type="submit">Confirm Delete</x-primary-button>
          </div>
          <div class="close-button">
            <x-secondary-button class="ml-3">Cancel</x-secondary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-modal-multi-line>
