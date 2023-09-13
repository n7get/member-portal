<?php

namespace App\Http\Requests\resources;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
            'access' => ['required', 'in:public,member,leadership'],
        ];
        
        if(request()->routeIs('files.store')) {
            $rules['data'] = ['required'];
        }

        if (request()->routeIs('files.store')) {
            array_push($rules['name'], 'unique:resources_files,name');
        }

        return $rules;
    }
}
