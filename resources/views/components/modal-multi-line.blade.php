@props([
    'modalId' => 'modal',
    'closeButtonClass' => 'close-button',
    'openModalButtonClass' => 'open-button',
    'urlAttribute' => 'data-url',
    'formId' => 'delete-form',
])

<div x-data="{ open: false }"
    x-show="open"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    id="{{ $modalId }}"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-500 bg-opacity-90"
>
  <div class="bg-white p-4"> 
      <div class="flex justify-between">
        <div class="font-bold">Confirm delete</div>
        <button type="button" class="close-button focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
      </div>
      {{ $slot }}
  </div>
</div>

@push('scripts')
<script>
  function findAttribute(element, attrName) {
    if (!element || element === document.body) {
      return null;
    }

    if (element.hasAttribute(attrName)) {
      return element.getAttribute(attrName);
    }

    return findAttribute(element.parentElement, attrName);
  }

  // Close modal support

  const modal = document.getElementById('{{ $modalId }}')
  function closeModal() {
    const data = Alpine.$data(modal);
    data.open = false;
  }

  window.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closeModal();
    }
  });

  const closebuttons = document.querySelectorAll('.{{ $closeButtonClass }}');
  closebuttons.forEach(button => {
    button.addEventListener('click', closeModal)  
  });
  
  // Open modal support

  const deleteButtons = document.querySelectorAll('.{{ $openModalButtonClass }}');
  deleteButtons.forEach((button) => {
    button.addEventListener('click', function(e) {
      const url = findAttribute(e.target, '{{ $urlAttribute }}');

      const deleteForm = document.getElementById('{{ $formId }}');
      deleteForm.setAttribute('action', url);

      const data = Alpine.$data(modal);
      data.open = true;
    });
  });
</script>
@endpush
