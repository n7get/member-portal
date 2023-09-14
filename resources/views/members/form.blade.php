<x-error-box />

<div class="flex justify-between bg-gray-300 px-2 py-3">
  <div>Basic information</div>
  @role('leadership')
  <div>
    <select name="status" id="status" class="ml-2 py-0">
      <option value="pending" {{ old('status', $member->status) == 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Active</option>
      <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
  </div>
  @endrole
</div>

<div class="mt-2">
  <x-input-label for="first_name">First Name:</x-input-label>
  <x-text-input class="block mt-1 w-full sm:w-1/2" type="text" id="first_name" name="first_name" maxlength="100" value="{{ old('first_name', $member->first_name) }}" autocomplete="given-name" required />
  <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
</div>

<div class="mt-2">
  <x-input-label for="last_name">Last Name:</x-input-label>
  <x-text-input class="block mt-1 w-full sm:w-1/2" type="text" id="last_name" name="last_name" maxlength="100" value="{{ old('last_name', $member->last_name) }}" autocomplete="family-name" required />
  <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
</div>

<div class="mt-2">
  <x-input-label for="mailing_address_street">Street:</x-input-label>
  <x-text-input class="block mt-1 w-full sm:w-1/2" type="text" id="mailing_address_street" name="mailing_address_street" maxlength="100" value="{{ old('mailing_address_street', $member->mailing_address_street) }}" autocomplete="street-address" />
  <x-input-error :messages="$errors->get('mailing_address_street')" class="mt-2" />
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/3">
    <x-input-label for="mailing_address_city">City:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="mailing_address_city" name="mailing_address_city" maxlength="100" value="{{ old('mailing_address_city', $member->mailing_address_city) }}" autocomplete="address-level2" />
  <x-input-error :messages="$errors->get('mailing_address_city')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/12">
    <x-input-label for="mailing_address_state">State:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="mailing_address_state" name="mailing_address_state" maxlength="2" value="{{ old('mailing_address_state', $member->mailing_address_state) }}" autocomplete="address-level1" />
  <x-input-error :messages="$errors->get('mailing_address_state')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/5">
    <x-input-label for="mailing_address_zip">Zip Code:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="mailing_address_zip" name="mailing_address_zip" maxlength="10" value="{{ old('mailing_address_zip', $member->mailing_address_zip) }}" autocomplete="postal-code" />
  <x-input-error :messages="$errors->get('mailing_address_zip')" class="mt-2" />
  </div>
</div>

<div class="flex items-center mt-2">
  <input type="hidden" name="part_year_nv_resident" value="0">
    <label class="ml-2 block mt-0.5" for="part_year_nv_resident" >
      <input type="checkbox" id="part_year_nv_resident" name="part_year_nv_resident" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('part_year_nv_resident', $member->part_year_nv_resident) ? 'checked' : '' }}>
      <span class="ml-2 text-sm text-gray-600">Part year NV resident</span>
    </label>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/4">
    <x-input-label for="callsign">Callsign:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="callsign" name="callsign" value="{{ old('callsign', $member->callsign) }}" required />
    <x-input-error :messages="$errors->get('callsign')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <x-input-label for="expiration">Expiration:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="expiration" name="expiration" placeholder="MM/DD/YY" value="{{ old('expiration', $member->expiration->format('m/d/y')) }}" required />
    <x-input-error :messages="$errors->get('expiration')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <x-input-label for="shares_callsign">SHARES callsign:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="shares_callsign" name="shares_callsign" value="{{ old('shares_callsign', $member->shares_callsign) }}" />
    <x-input-error :messages="$errors->get('shares_callsign')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/4">
    <x-input-label for="gmrs_callsign">GMRS callsign:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="gmrs_callsign" name="gmrs_callsign" value="{{ old('gmrs_callsign', $member->gmrs_callsign) }}" />
    <x-input-error :messages="$errors->get('gmrs_callsign')" class="mt-2" />
  </div>
</div>

<div class="sm:flex">
  <div class="mt-2 sm:basis-1/2">
    <x-input-label for="cellPhone">Cellphone:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="cellPhone" name="cellPhone" value="{{ old('cellPhone', $member->cellPhone) }}" autocomplete="tel" required />
    <x-input-error :messages="$errors->get('cellPhone')" class="mt-2" />
  </div>

  <div class="mt-2 sm:ml-4 sm:basis-1/2">
    <x-input-label for="cell_sms_carrier">Cell/SMS carrier:</x-input-label>
    <x-text-input class="block mt-1 w-full" type="text" id="cell_sms_carrier" name="cell_sms_carrier" value="{{ old('cell_sms_carrier', $member->cell_sms_carrier) }}" required />
    <x-input-error :messages="$errors->get('cell_sms_carrier')" class="mt-2" />
  </div>
</div>

<div class="flex items-center mt-2 sm:mt-4 sm:ml-4 sm:basis-1/2">
  <input type="hidden" name="winlink_account" value="0">
    <label class="ml-2 block mt-0.5" for="winlink_account" >
      <input type="checkbox" id="winlink_account" name="winlink_account" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('winlink_account', $member->winlink_account) ? 'checked' : '' }}>
      <span class="ml-2 text-sm text-gray-600">Winlink account</span>
    </label>
</div>

<div class="mt-5 sm:flex sm:space-x-4">
  <div class="sm:basis-1/2">
    <div class="bg-gray-300 px-2 py-3">
      Courses you have completed
    </div>
    <div class="mt-2">
      @foreach($certifications as $certification)
        <div class="flex items-center mt-2">
          <label class="ml-2 block mt-0.5" for="certifications-{{ $certification->id }}">
            <input type="checkbox" id="certifications-{{ $certification->id }}" name="certifications[{{ $certification->id }}]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ in_array($certification->id, old('certifications', $member->certifications->pluck('id')->toArray())) ? 'checked' : '' }}>
            <span class="ml-2 text-sm text-gray-600">{{ $certification->description }}</span>
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
            <input type="checkbox" name="capabilities[{{ $capability->id }}][base]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1"
              {{ $formCapabilities->base($capability->id) ? 'checked' : '' }}>
          </div>
          <div class="text-center w-1/2">
            <input type="checkbox" name="capabilities[{{ $capability->id }}][portable]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1"
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
          <label class="ml-2 block mt-0.5" for="others-{{ $other->id }}-id">
            <input type="checkbox" id="others-{{ $other->id }}-id" name="others[{{ $other->id }}][id]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="{{ $other->id }}" {{ $formOthers->has($other->id) ? 'checked' : '' }}>
            <span class="ml-2 text-sm text-gray-600">{{ $other->description }}</span>
          </label>
        </div>
        @if($other->needs_extra_info)
          <div class="ml-9 mt-1">
            <div class="text-sm text-gray-600">{{ $other->prompt }}</div>
            <x-text-input class="block mt-1 w-full sm:w-1/2" type="text" name="others[{{ $other->id }}][extra_info]" value="{{ $formOthers->extra_info($other->id) }}" />
            <x-input-error :messages="$errors->get('others[{{ $other->id }}][extra_info]')" class="mt-2" />
          </div>
        @endif
      </div>
    @endforeach
  </div>
</div>
