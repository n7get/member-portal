<?php

namespace App\Http\Requests\members;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Or your own authorization logic
    }

    public function rules()
    {
        $orderRule = ['required', 'integer'];
        if (request()->routeIs('certifications.store')) {
            array_push($orderRule, 'unique:certifications');
        }
    
        return [
            'description' => ['required', 'string', 'max:255'],
            'order' => $orderRule,
        ];
    }
}
