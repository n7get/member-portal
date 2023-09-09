<?php

namespace App\Http\Requests\resources;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'access' => ['required', 'string'],
            'order' => ['required', 'integer'],
        ];
    }
}
