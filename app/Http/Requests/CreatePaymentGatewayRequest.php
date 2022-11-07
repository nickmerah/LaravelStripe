<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentGatewayRequest extends FormRequest
{

    public function authorize()
    {
        return false;
    }


    public function rules()
    {
        return [
            'pgname' => 'required',
            'pgdescription' => 'required',
            'isActive' => 'required'
        ];
    }
}
