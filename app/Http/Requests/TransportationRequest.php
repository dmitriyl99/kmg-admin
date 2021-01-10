<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportationRequest extends FormRequest
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
            'transporter' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric',
            'phone' => 'nullable|numeric|max:255',
            'transportation_paid' => 'required',
            'delivered' => 'required',
            'carrier_comment' => 'nullable|string|max:255',

            'seller_name' => 'required|string|max:255',
            'lot_number' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'seller_phone' => 'required|string|max:255',
            'seller_address' => 'required|string|max:255',
            'pick_up_by' => 'nullable|date',
            'seller_comment' => 'nullable|string|max:255',

            'cargo_id' => 'required|exists:cargos,id',
            'warehouse' => 'required|string|max:255',
            'purchased_date' => 'nullable|date',
            'paid' => 'required',
            'ready' => 'required',
            'has_photos' => 'required',
            'status' => 'nullable|string|max:255'
        ];
    }
}
