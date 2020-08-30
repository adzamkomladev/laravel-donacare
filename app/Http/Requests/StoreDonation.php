<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonation extends FormRequest
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
            'patient_id' => 'required|integer|exists:users,id',
            'value' => 'required|string',
            'hospital_name' => 'string|string|max:255',
            'hospital_location' => 'string|string|max:255',
            'description' => 'nullable|string',
            'date_needed' => 'required|date',
            'payment_status' => ['required', Rule::in(['free', 'charged'])],
            'doctor_name' => 'required|string|max:255',
            'doctor_phone' => 'required|string|max:15',
            'doctor_staff_id' => 'required|string|max:40',
            'payment_method' => 'nullable|string',
            'share_location' => 'required|boolean',
            'type' => ['required', Rule::in(['blood', 'organ', 'funds'])]
        ];
    }
}
