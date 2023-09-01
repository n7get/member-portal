<x-app-layout>
  <x-slot name="header">
      <x-heading-edit heading="Member {{ $member->callsign }}" right-nav-route="members.edit" right-nav-id="{{ $member->id }}" />
  </x-slot>

  <div class="max-w-5xl sm:mt-4 sm:pb-2 mx-auto bg-white border-t">
    <div>
      <div class="flex justify-between bg-gray-300 px-2 py-3">
        <div>Basic Information</div>
        <div class="ml-2 mr-2">{{ $member->status }}</div>
      </div>
      <div class="ml-2">
        <div class="flex">
          <div>
            {{ $member->first_name }}
            {{ $member->last_name }}
          </div>
        </div>
        <div>{{ $member->mailing_address_street }}</div>
        <div class="flex">
          <div>{{ $member->mailing_address_city }}</div>,
          <div>{{ $member->mailing_address_state }}</div>
          <div class="ml-2">{{ $member->mailing_address_zip }}</div>
        </div>
        @if ($member->part_year_nv_resident)
          <div>Is part year NV resident</div>
        @endif
        <div class="flex mt-4">
          <div>Email:</div>
          <div class="ml-2">
            @role('admin')
              <a href="{{ route('users.show', $member->user_id) }}" class="text-blue-500">
            @endrole
                {{ $member->user->email }}
            @role('admin')
              </a>
            @endrole
          </div>
        </div>
        @if ($member->callsign)
        <div class="flex mt-4">
          <div>Callsign:</div>
          <div class="ml-2">{{ $member->callsign }}</div>
          <div class="ml-4">License Expiration:</div>
          <div class="ml-2">{{ $member->expiration->format('m/d/y') }}</div>
        </div>
        @endif
        @if ($member->gmrs_callsign)
          <div class="flex mt-4">
            <div>GMRS Callsign:</div>
            <div class="ml-2">{{ $member->gmrs_callsign }}</div>
          </div>
        @endif
        @if ($member->callsign)
          <div class="flex mt-4">
            <div>Cell/SMS phone:</div>
            <div class="ml-2">{{ $member->cellPhone }}</div>
            <div class="ml-4">Cell/SMS carrier:</div>
            <div class="ml-2">{{ $member->cell_sms_carrier }}</div>
          </div>          
        @endif
        @if($member->winlink_account)
          <div class="mt-4">Has Winlink account</div> 
        @endif
      </div>
    </div>

    <div class="ml-2 mt-4">
      <div class="bg-gray-300 px-2 py-3">
        Courses you have completed
      </div>
      @foreach ($member->certifications as $cert)
        <div class="mt-2">
          {{ $cert->description }}
        </div>
      @endforeach
    </div>

    <div class="ml-2 mt-4">
      <div class="bg-gray-300 px-2 py-3">
        Capabilities
      </div>
      @foreach ($member->capabilities as $cap)
        <div class="mt-2">
          {{ $cap->description }}
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      <div class="bg-gray-300 px-2 py-3 mt-2">
        Skills and equipment you would agree to use
      </div>
      @foreach ($member->others as $other)
        <div class="flex mt-2">
          <div>{{ $other->description }}</div>
          @if ($other->needs_extra_info)
          @if ($other->prompt)
          ,
          <div class="ml-2">{{ $other->prompt }}</div>
          @endif
          :
            <div class="ml-2">{{ $other->pivot->extra_info }}</div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</x-app-layout>
