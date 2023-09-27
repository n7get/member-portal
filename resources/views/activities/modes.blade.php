<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Activity Modes"/>
  </x-slot>

  <x-description-list submitRoute="{{ route('activity_modes.save') }}" itemList="{!! $activity_modes !!}" />
</x-app-layout>
