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
            'user_id' => 'required|integer|exists:users,id',
            'value' => 'required|string',
            'value_type' => 'required|string',
            'hospital_id' => 'required|integer|exists:hospitals,id',
            'description' => 'nullable|string',
            'date_needed' => 'required|date',
            'payment_status' => ['required', Rule::in(['free', 'charged'])],
            'payment_method' => 'sometimes|string',
            'share_location' => 'required|boolean',
            'type' => ['required', Rule::in(['blood', 'organ', 'funds'])],
            'quantity' => 'required|integer',
            'service_id' => 'required|integer|exists:services,id',
            'cost' => 'nullable|numeric',
        ];
    }
}
