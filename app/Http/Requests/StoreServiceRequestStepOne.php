<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequestStepOne extends FormRequest
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
            'service_id' => 'required|integer|exists:services,id',
            'description' => 'required|string',
            'hospital_name' => 'nullable|string|max:255',
            'hospital_contact' => 'nullable|string|max:255',
            'hospital_location' => 'nullable|string|max:255',
            'doctor_name' => 'nullable|string|max:255',
            'doctor_contact' => 'nullable|string|max:255'
        ];
    }
}
