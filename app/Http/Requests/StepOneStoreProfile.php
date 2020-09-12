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
            'blood_group' => 'required|string|max:100',
            'role' => ['required', Rule::in(['patient', 'donor'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
        ];
    }
}
