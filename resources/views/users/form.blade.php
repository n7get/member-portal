<x-error-box />

<div class="mt-3">
  <label for="email">Email:</label>
  <div class="mt-1">
    <input class="w-full type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
  </div>
</div>

<div class="mt-3">
  <label for="email_verified_at">Email verified at:</label>
  <input class="w-full" type="text" id="email_verified_at" name="email_verified_at" value="{{ old('email_verified_at', $user->email_verified_at) }}">
</div>

<div class="mt-3">
  <label for="remember_token">Rember token:</label>
  <input class="w-full" type="text" id="remember_token" name="remember_token" value="{{ old('remember_token', $user->remember_token )}}">
</div>

<!-- Password -->
<div class="mt-3">
  <label for="password">Password:</label>
  <div class="mt-1">
    <input id="password" class="block mt-1 w-full"
      type="password"
      name="password"
     autocomplete="new-password" />
  </div>
</div>

<!-- Confirm Password -->
<div class="mt-3">
  <label for="password_confirmation">Confirm Password</label>
  <div class="mt-1">
    <input id="password_confirmation" class="block mt-1 w-full"
      type="password"
      name="password_confirmation" autocomplete="new-password" />
  </div>
</div>

<div class="flex items-center mt-3">
  <input type="hidden" name="admin" value="0">
  <input type="checkbox" id="admin" name="admin" value="1" {{ old('admin', $admin) ? 'checked' : '' }}>
  <label class="ml-2 block mt-0.5" for="admin" >Admin</label>
</div>

<div class="flex items-center mt-3">
  <input type="hidden" name="leadership" value="0">
  <input type="checkbox" id="leadership" name="leadership" value="1" {{ old('leadership', $leadership) ? 'checked' : '' }}>
  <label class="ml-2 block mt-0.5" for="leadership" >Leadership</label>
</div>

<div class="flex items-center mt-3">
  <input type="hidden" name="member" value="0">
  <input type="checkbox" id="member" name="member" value="1" {{ old('member', $member) ? 'checked' : '' }}>
  <label class="ml-2 block mt-0.5" for="member" >Member</label>
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
