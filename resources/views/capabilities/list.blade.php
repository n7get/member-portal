<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Members Capabilities"/>
  </x-slot>

  <x-description-list submitRoute="{{ route('capabilities.save') }}" itemList="{!! $capabilities !!}" />
</x-app-layout>
