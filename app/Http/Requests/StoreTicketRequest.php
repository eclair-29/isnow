<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
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
            'application_type' => 'required',
            'request_type' => 'required',
            'supervisor' => 'required_if:application_type,1',
            'account_type' => 'required_if:application_type,2',
            'purpose' => 'required',
            'ticket_id' => 'required|unique:requests',
            'user_id' => 'required',
            'status_id' => 'required',
        ];
    }
}
