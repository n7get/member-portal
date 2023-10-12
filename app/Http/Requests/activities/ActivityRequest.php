<?php

namespace App\Http\Requests\activities;

use App\Casts\DateHourMinuteCast;
use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
   * @return array[<string, \Illuminate\Contracts\Validation\ValidationRule', 'array|string]>
   */
  public function rules(): array
  {
    return [
      'description' => ['required', 'string'],
      'date' => ['required', 
        function ($attribute, $value, $fail) {
          if (! \DateTime::createFromFormat('m-d-y H:i', $value)) {
            $fail('The date must be in the form of mm-dd-yy hh:mm');
          }
        },
      ],
      'duration' => ['required',
        function ($attribute, $value, $fail) {
          if (! preg_match('/^((\d+):)?((\d+):)?(\d+)$/', $value)) {
            $fail('The duration must be in the form of dd:hh:mm or hh:mm or mm');
          }
        },
      ],
      'location' => ['required', 'string'],
      'notes' => ['nullable', 'string'],
    ];
  }
}
