<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatosRequest extends FormRequest
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
            'dni'=>'required',
            'paterno'=>'required',
            'materno'=>'required',
            'nombres'=>'required',
            'fecha_nacimiento'=>'required',
            'idsexo'=>'required',
            'idgrado'=>'required',
            'idsede'=>'required',
            'idespecialidad'=>'required',
            'direccion'=>'required',
            'idubigeo'=>'required',
            'idcolegio'=>'required',
        ];
    }
}
