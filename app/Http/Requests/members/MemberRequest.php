<?php

namespace App\Http\Requests\members;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'max:100'],
            'last_name' => ['required', 'max:100'],
            'mailing_address_street' => ['max:100'],
            'mailing_address_city' => ['max:100'],
            'mailing_address_state' => ['max:2'],
            'mailing_address_zip' => ['max:10'],
            'callsign' => ['required', 'max:7'],
            'expiration' => ['required', 'date'],
            'shares_callsign' => ['max:10'],
            'gmrs_callsign' => ['max:10'],
            'cellPhone' => ['required', 'max:20'],
            'cell_sms_carrier' => ['required', 'max:20'],
        ];

        if (request()->routeIs('members.store')) {
            array_push($rules['callsign'], 'unique:members');
        }

        if ($this->mailing_address_street || $this->mailing_address_city || $this->mailing_address_state || $this->mailing_address_zip) {
            array_unshift($rules['mailing_address_street'], 'required');
            array_unshift($rules['mailing_address_city'], 'required');
            array_unshift($rules['mailing_address_state'], 'required');
            array_unshift($rules['mailing_address_zip'], 'required');
        }

        return $rules;
    }
}
