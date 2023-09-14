<!-- Email -->
<div class="mt-3">
  <x-input-label for="email">Email:</x-input-label>
  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" autofocus required />
  <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Email Verified At -->
<div class="mt-3">
  <x-input-label for="email_verified_at">Email verified at:</x-input-label>
  <x-text-input id="email_verified_at" class="block mt-1 w-full" type="text" name="email_verified_at" :value="old('email_verified_at', $user->email_verified_at)" />
  <x-input-error :messages="$errors->get('email_verified_at')" class="mt-2" />
</div>

<!-- Remember Token -->
<div class="mt-3">
  <x-input-label for="remember_token">Remember token:</x-input-label>
  <x-text-input id="remember_token" class="block mt-1 w-full" type="text" name="remember_token" :value="old('remember_token', $user->remember_token)" />
  <x-input-error :messages="$errors->get('remember_token')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-3">
  <x-input-label for="password">Password:</x-input-label>
  <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
  <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-3">
  <x-input-label for="password_confirmation">Confirm Password:</x-input-label>
  <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<!-- Admin -->
<div class="block mt-4">
  <input type="hidden" name="admin" value="0">
  <label for="admin" class="inline-flex items-center">
    <input id="admin" name="admin" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" @checked(old('admin', $admin))>
    <span class="ml-2 text-sm text-gray-600">Admin</span>
  </label>
</div>

<!-- Leadership -->
<div class="block mt-4">
  <input type="hidden" name="leadership" value="0">
  <label for="leadership" class="inline-flex items-center">
    <input id="leadership" name="leadership" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" @checked(old('leadership', $leadership))>
    <span class="ml-2 text-sm text-gray-600">Leadership</span>
  </label>
</div>

<!-- Member -->
<div class="block mt-4">
  <input type="hidden" name="member" value="0">
  <label for="member" class="inline-flex items-center">
    <input id="member" name="member" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" @checked(old('member', $member))>
    <span class="ml-2 text-sm text-gray-600">Member</span>
  </label>
</div>

<!-- Resources -->
<div class="block mt-4">
  <input type="hidden" name="resources" value="0">
  <label for="resources" class="inline-flex items-center">
    <input id="resources" name="resources" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" @checked(old('resources', $resources))>
    <span class="ml-2 text-sm text-gray-600">Resources</span>
  </label>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const inputElement = document.getElementById('email_verified_at');

    inputElement.addEventListener('click', function() {
        if (this.value === '') {
          const now = new Date();

          const date = [
            now.getUTCMonth() + 1, // Months are zero-based
            now.getUTCDate(),
            now.getUTCFullYear().toString().substr(-2) // Last two digits of the year
          ].join('/');

          const time = [
            now.getUTCHours(),
            now.getUTCMinutes(),
            now.getUTCSeconds()
          ].join(':');
          event.target.value = `${date} ${time}`;
        }
    });
  });
</script>
@endpush
