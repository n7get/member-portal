<?php

// CapabilityRequest.php

namespace App\Http\Requests\members;

use Illuminate\Foundation\Http\FormRequest;

class CapabilityRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Or your own authorization logic
    }

    public function rules()
    {
        $orderRule = ['required', 'integer'];
        if (request()->routeIs('capabilities.store')) {
            array_push($orderRule, 'unique:member_capabilities');
        }
    
        return [
            'description' => ['required', 'string', 'max:255'],
            'order' => $orderRule,
        ];
    }
}
