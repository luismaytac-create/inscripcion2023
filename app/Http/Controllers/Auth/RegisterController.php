<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Catalogo;
use App\Models\Cronograma;
use App\User;
Use Illuminate\Http\Request; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Styde\Html\Facades\Alert;
use Validator;
use Illuminate\Support\Facades\Log;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {		
			$sss=$data['tipo_documento'];
	        return Validator::make($data, [
                'dni' => 'required|numeric|unique:users,dni|fecha_ins|dni_regis_val|dni_orce|dni_lon_val:'.$sss,
                'password' => 'required|min:6|confirmed',
				'captcha' => 'required|captcha',
				'email' => 'required|email|unique:users,email',
				'tipo_documento'=> 'required|numeric|tipo_doc_val',
                'celular' => 'required|numeric|celular_length',
                'respuesta'=> 'required'
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
	  
        $role = Catalogo::Table('ROLES')->where('codigo','alum')->first();
		$tipo_doc=$data['tipo_documento'];
		
		if($tipo_doc==1){
			$tip=28;
		}
		if($tipo_doc==2){
			$tip=33;
		}
		if($tipo_doc==3) {
		    $tip=32;
        }
        if($tipo_doc==5) {
            $tip=116;
        }
        if($tipo_doc==4) {
            $tip=117;
        }



        $res = false;

        if($data['respuesta']=='SI'){


            $res= true;
        }
		
        return User::create([
            'dni' => $data['dni'],
            'password' => $data['password'],
            'activo' => true,
            'idrole'=>$role->id,
			'email'=>$data['email'],
			'idtipo_identificacion'=>$tip,
            'colegio' => $res,
            'celular'=>$data['celular']
        ]);


    }
}
