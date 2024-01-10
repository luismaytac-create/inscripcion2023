<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComplementarioRequest extends FormRequest
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
            'idrazon'=>'required',
            'idtipopreparacion'=>'required',
            'mes'=>'required|numeric',

            'numeroveces'=>'required',
            'idingresoeconomico'=>'required',
            'idpublicidad'=>'required',
            'sisfoh'=>'required',
            'magisterio'=>'required'
        ];
    }
}
