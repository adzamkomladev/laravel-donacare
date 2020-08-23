<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StepTwoStoreProfile extends FormRequest
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
            'mobile_money_name' => 'required|string|max:100',
            'mobile_money_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:100',
            'role' => ['required', Rule::in(['patient', 'donor'])],
            'medical_details' => 'nullable|string'
        ];
    }
}
