<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        $emailRule = ['required', 'string', 'email', 'max:255'];
        if (! request()->routeIs('users.update') || $this->input('email') !== $user->email) {
            array_push($emailRule, 'unique:users');
        }

        $rules = [
            'email' => $emailRule,
        ];

        if (! request()->routeIs('users.update') || $this->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        return $rules;
    }
}
