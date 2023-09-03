<?php

namespace App\Http\Requests\members;

use Illuminate\Foundation\Http\FormRequest;

class OtherRequest extends FormRequest
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
        $orderRule = ['required', 'integer'];
        if (request()->routeIs('others.store')) {
            array_push($orderRule, 'unique:others');
        }

        return [
            'description' => ['required', 'string', 'max:255'],
            'needs_extra_info' => 'required|boolean',
            'prompt' => 'nullable|max:255',
            'order' => $orderRule,
        ];
    }
}
