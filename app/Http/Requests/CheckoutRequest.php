<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'name_acara' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'tglacara' => 'required|date_format:Y-m-d',
            'porsi' => 'required',
            'deposit' => 'required',
            'service' => 'required',
            'request_tambahan' => 'required',
            'request_sambal' => 'required',
            'request_sambal2' => 'required',
            'request_saung' => 'required'

        ];
    }
}
