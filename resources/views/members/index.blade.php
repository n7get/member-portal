<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Members" />
  </x-slot>

  <div class="page">
    <div class="max-w-5xl container">
      <div class="panel">
        <x-member-list :members="$members" />
      </div>
    </div>
  </div>
</x-app-layout>
