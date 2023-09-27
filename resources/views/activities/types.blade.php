<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Activity Types"/>
  </x-slot>

  <x-description-list submitRoute="{{ route('activity_types.save') }}" itemList="{!! $activity_types !!}" />
</x-app-layout>
