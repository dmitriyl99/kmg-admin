<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'vin' => 'required|string|max:255',
            'port' => 'nullable|string|max:255',
            'received_at' => 'nullable|date',
            'destination_country' => 'required|string|max:255',

            'transportation_from' => 'nullable|string|max:255',
            'transportation_address' => 'nullable|string|max:255',
            'transportation_price' => 'nullable|numeric',

            'date_received' => 'nullable|date',
            'key' => 'nullable|string|in:yes,no',

            'container_id' => 'nullable|integer|exists:containers,id',
            'total_due' => 'nullable|numeric',

            'postal_service' => 'nullable|string|max:255',
            'tracking_number' => 'nullable|string|max:255',

            'images' => 'nullable|array',
            'images.*' => 'mimes:jpg,jpeg,png|max:5120',
        ];
    }
}
