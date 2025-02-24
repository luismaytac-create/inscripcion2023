<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\RegistroUser;
use Carbon\Carbon;
use App\User;
use Auth;
use Alert;
use DB;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'dni' => 'required',
            'password' => 'required',
        ]);
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
        'dni' => $request->get('dni'),
        'password' => $request->get('password'),
        'activo' => true
        ];
    }
    function authenticated(Request $request, $user)
    {


        $ip=$request->getClientIp();
        $hora= Carbon::now()->toDateTimeString();

        $data['date'] = $hora;

        $data['ip'] =  $ip;



        if(isset($user->idrole)){

            if($user->idrole==13){
                $cuentaconfima=  DB::table("view_ingresante_25_1")->where('numero_identificacion',$user->dni)->count();
                    if($cuentaconfima>0){



                    }else {
                        Alert::danger('Ingresantes')
                            ->details('Tienes que ser ingresante .');
                        Auth::logout();
                        return redirect()->to('/');

                    }


            }

        }else{
            Auth::logout();
        }

        $data['idusuario'] =  $user->id;

        RegistroUser::create($data);



    }




}
