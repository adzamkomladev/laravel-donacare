<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StepOneStoreProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'other_names' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'home_address' => 'nullable|string|max:100',
            'gender' => ['required', Rule::in(['male', 'female'])],
        ];
    }
}