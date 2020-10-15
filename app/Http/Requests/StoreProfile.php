<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfile extends FormRequest
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
            'blood_group' => 'required|string|max:100',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'role' => ['required', Rule::in(['patient', 'donor'])],
            'other_names' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|max:100',
            'jurisdiction' => 'sometimes|string|max:100',
            'mobile_money_name' => 'sometimes|string|max:100',
            'mobile_money_number' => 'sometimes|string|max:15',
            'medical_details' => 'sometimes|string',
        ];
    }
}
