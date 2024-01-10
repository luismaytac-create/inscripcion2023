<?php

namespace App\Http\Requests;

use App\Models\Pais;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UpdateSecundariosRequest extends FormRequest
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
        $data = Request::all();
        
        $validate =  [
            'email'=> 'required|email',
            'idsexo'=> 'required',
            'telefono_celular'=> 'required',
            'telefono_fijo'=> 'required',
            'telefono_varios'=> 'required',
            'idpais'=> 'required',
            'idpaisnacimiento'=> 'required',
            
            
            'file'=> 'image|mimes:jpg,jpeg,png,',
            'talla'=>'required|numeric|min:1|max:2',
            'peso'=>'required|numeric|min:30|max:150',
            'direccion'=>'required',
            'fecha_nacimiento'=>'required|date_format:Y-m-d|fecha_nacimiento:'.$data['numero_identificacion'],
            'inicio_estudios'=>'required',
            'fin_estudios'=>'required',
            'cuarta_df'=>'required',
        ];
        if (array_key_exists('idpais',$data)) {

            if(is_numeric($data['idpais'])){
                $pais = Pais::find($data['idpais']);
                if($pais->codigo=='PE') $validate = array_add($validate,'idubigeo','required');
            }
        }
        if (array_key_exists('idpaisnacimiento',$data)) {
            if (is_numeric($data['idpaisnacimiento'])) {
                $pais_nacimiento = Pais::find($data['idpaisnacimiento']);
                if($pais_nacimiento->codigo=='PE') $validate = array_add($validate,'idubigeonacimiento','required');
            }
        }




        return $validate;
    }
    public function messages()
    {
        return[
            'file.image'=>'Ha colocado un archivo que no es imagen en la fotografía',
            'fecha_nacimiento.date_format'=>'La fecha de nacimiento que ha ingresado no esta en el formato (año, mes, dia)',
            'cuarta_df.required'=>'Es obligatorio seleccionar la cuarta disposición del reglamento. Por favor, asegúrese de elegirla.',
        ];
    }
}
