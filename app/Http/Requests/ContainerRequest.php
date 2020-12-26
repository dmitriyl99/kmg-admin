<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContainerRequest extends FormRequest
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
            'container_number' => 'required|string',
            'booking_number' => 'nullable|string',
            'shipping_line' => 'nullable|string',
            'container_status_id' => 'required|integer|exists:container_statuses,id',
            'port' => 'required|string',
            'destination' => 'required|string',
            'capacity' => 'required|integer',
            'paid' => 'nullable',
            'tracking_link' => 'nullable|string',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',

            'images' => 'nullable|array',
            'images.*' => 'mimes:jpg,jpeg,png|max:5120',

            'invoice.active' => 'nullable',
            'invoice.date' => 'nullable|date',
            'invoice.container_size' => 'required|string',
            'invoice.company' => 'required|string',
            'invoice.total_due' => 'nullable|integer',
            'invoice.shipper' => 'nullable|string',
            'invoice.consignee' => 'nullable|string'
        ];
    }
}
