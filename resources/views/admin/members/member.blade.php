<x-error-box />

<div class="mt-2">
  <label for="first_name">First Name:</label>
  <div class="mt-1">
    <input class="w-full sm:w-1/2" type="text" id="first_name" name="first_name" maxlength="100" value="{{ old('first_name', $member->first_name) }}" autocomplete="given-name" required>
  </div>
</div>

<div class="mt-2">
  <label for="last_name">Last Name:</label>
  <div class="mt-1">
    <input class="w-full sm:w-1/2" type="text" id="last_name" name="last_name" maxlength="100" value="{{ old('last_name', $member->last_name) }}" autocomplete="family-name" required>
  </div>
</div>

<div class="mt-2">
  <label for="mailing_address_street">Street:</label>
  <div class="mt-1">
    <input class="w-full sm:w-1/2" type="text" id="mailing_address_street" name="mailing_address_street" maxlength="100" value="{{ old('mailing_address_street', $member->mailing_address_street) }}" autocomplete="street-address">
  </div>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/3">
    <label for="mailing_address_city">City:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="mailing_address_city" name="mailing_address_city" maxlength="100" value="{{ old('mailing_address_city', $member->mailing_address_city) }}" autocomplete="address-level2">
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/12">
    <label for="mailing_address_state">State:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="mailing_address_state" name="mailing_address_state" maxlength="2" value="{{ old('mailing_address_state', $member->mailing_address_state) }}" autocomplete="address-level1">
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/5">
    <label for="mailing_address_zip">Zip Code:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="mailing_address_zip" name="mailing_address_zip" maxlength="10" value="{{ old('mailing_address_zip', $member->mailing_address_zip) }}" autocomplete="postal-code">
    </div>
  </div>
</div>

<div class="flex items-center mt-2">
  <input type="hidden" name="part_year_nv_resident" value="0">
  <input type="checkbox" id="part_year_nv_resident" name="part_year_nv_resident" value="1" {{ old('part_year_nv_resident', $member->part_year_nv_resident) ? 'checked' : '' }}>
  <label class="ml-2 block mt-0.5" for="part_year_nv_resident" >Part year NV resident</label>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/4">
    <label for="callsign">Callsign:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="callsign" name="callsign" value="{{ old('callsign', $member->callsign) }}" required>
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <label for="expiration">Expiration:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="expiration" name="expiration" placeholder="MM/DD/YY" value="{{ old('expiration', $member->expiration) }}" required>
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <label for="shares_callsign">SHARES callsign:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="shares_callsign" name="shares_callsign" value="{{ old('shares_callsign', $member->shares_callsign) }}">
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <label for="gmrs_callsign">GMRS callsign:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="gmrs_callsign" name="gmrs_callsign" value="{{ old('gmrs_callsign', $member->gmrs_callsign) }}">
    </div>
  </div>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/2">
    <label for="cellPhone">Cellphone:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="cellPhone" name="cellPhone" value="{{ old('cellPhone', $member->cellPhone) }}" autocomplete="tel" required>
    </div>
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/2">
    <label for="cell_sms_carrier">Cell/SMS carrier:</label>
    <div class="mt-1">
      <input class="w-full" type="text" id="cell_sms_carrier" name="cell_sms_carrier" value="{{ old('cell_sms_carrier', $member->cell_sms_carrier) }}" required>
    </div>
  </div>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/2">
    <label for="email">Email:</label>
    <div class="mt-1">
      <input class="w-full" type="email" id="email" name="email" value="{{ old('email', $member->email) }}" autocomplete="email" required>
    </div>
  </div>

  <div class="flex items-center mt-2 sm:mt-10 sm:ml-4 sm:basis-1/2">
    <input type="hidden" name="winlink_account" value="0">
    <input type="checkbox" id="winlink_account" name="winlink_account" value="1" {{ old('winlink_account', $member->winlink_account) ? 'checked' : '' }}>
    <label class="ml-2 block mt-0.5" for="winlink_account" >Winlink account</label>
  </div>
</div>

<div class="mt-5 sm:flex sm:space-x-4">
  <div class="sm:basis-1/2">
    <div class="bg-gray-300 px-2 py-3">
      Courses you have completed
    </div>
    <div class="mt-2">
      @foreach($certifications as $certification)
        <div class="flex items-center mt-2">
          <input type="checkbox" id="certifications-{{ $certification->id }}" name="certifications[{{ $certification->id }}]" value="1"
          {{ in_array($certification->id, old('certifications', $member->certifications->pluck('id')->toArray())) ? 'checked' : '' }}>
          <label class="ml-2 block mt-0.5" for="certifications-{{ $certification->id }}">
            {{ $certification->description }}
          </label>
        </div>
      @endforeach
    </div>
  </div>

  <div class="mt-5 sm:mt-0 sm:basis-1/2">
    <div class="bg-gray-300 px-2 py-3">
      Capabilities
    </div>
    <div class="flex font-bold">
      <div class="grow">Capability</div>
      <div class="w-24 ml-auto flex">
        <div class="text-center w-1/2">Base</div>
        <div class="text-center w-1/2">Port</div>
      </div>
    </div>
    @foreach($capabilities as $capability)
      <div class="flex">
        <div class="grow text-ellipsis overflow-hidden">{{ $capability->description }}</div>
        <div class="w-24 ml-auto flex">
          <div class="text-center w-1/2">
            <input type="checkbox" name="capabilities[{{ $capability->id }}][base]" value="1"
              {{ $formCapabilities->base($capability->id) ? 'checked' : '' }}>
          </div>
          <div class="text-center w-1/2">
            <input type="checkbox" name="capabilities[{{ $capability->id }}][portable]" value="1"
              {{ $formCapabilities->portable($capability->id) ? 'checked' : '' }}>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<div class="mt-5">
  <div class="bg-gray-300 px-2 py-3 mt-2">
    Skills and equipment you would agree to use
  </div>
  <div>
    @foreach($others as $other)
      <div class="border-b-2 pt-2 pb-2">
        <div class="flex items-center">
          <input type="checkbox" id="others-{{ $other->id }}-id" name="others[{{ $other->id }}][id]" value="{{ $other->id }}" {{ $formOthers->has($other->id) ? 'checked' : '' }}>
          <label class="ml-2 block mt-0.5" for="others-{{ $other->id }}-id">{{ $other->description }}</label>
        </div>
        @if($other->needs_extra_info)
          <div>
            <div>{{ $other->prompt }}</div>
            <div class="pb-1">
              <input class="w-full sm:w-1/2" type="text" name="others[{{ $other->id }}][extra_info]" value="{{ $formOthers->extra_info($other->id) }}">
            </div>
          </div>
        @endif
      </div>
    @endforeach
  </div>
</div>
