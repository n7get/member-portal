<x-app-layout>
  <x-slot name="header">
    <x-heading-create heading="Members Certifications" />
  </x-slot>

  <x-description-list submitRoute="{{ route('certifications.save') }}" itemList="{!! $certifications !!}" />
</x-app-layout>
