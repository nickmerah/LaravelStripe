<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentMethodRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'pname' => 'required',
            'pdescription' => 'required',
            'pcharges' => 'required'
        ];
    }
}
