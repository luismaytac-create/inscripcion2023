<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use  Alert;
use Response;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Log;
class EmailController extends Controller{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $existe = Postulante::where('idusuario',Auth::user()->id)->count();

        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');

            return back();

        }else {
            if( $user->confirmo == true ){
                return view('datos.email.ok');
            }else {
                return view('datos.email.index');
            }
        }




    }

    public function enviar() {
        $id = Auth::user()->id;
        $user = User::find($id);
        $myEmail = Auth::user()->email;
       // $myEmail = 'dibucam9@gmail.com';
        $codigo = strtoupper(str_random(6));


        $date = Carbon::now();

        if ( isset($user->token))  {

            if( $date < $user->token_date){

                Mail::to($myEmail)->send(new MyTestMail($user->token));
            }else {
                $user->token = $codigo;
                $user->token_date = Carbon::now()->addDays(1);
                $user->save();
                Mail::to($myEmail)->send(new MyTestMail($codigo));
            }

        }else {
            $user->token = $codigo;
            $user->token_date = Carbon::now()->addDays(1);
            $user->save();
            Mail::to($myEmail)->send(new MyTestMail($codigo));
        }





        $res['data'] = 'OK';
        // return $res;
        return Response::json(['data' => 'OK']);
    }


    public function codigo(Request $request) {



        $codigo = $request->codigo;
        $id = Auth::user()->id;
        $user = User::find($id);

        if( $user->token == $codigo){

            $user->confirmo =true;
            $user->save();

            return Response::json(['data' => 'OK']);
        }else {
            return Response::json(['data' => 'FALSE']);
        }




    }


    public function check(Request $request) {
        $email = $request->email;
        $id = Auth::user()->id;
        $user = User::find($id);
        $connn = User::where('email',$email)->count();
        if($connn == 0 ){


            $user->email = $email;
            $user->save();

            Postulante::where('idusuario',$id)->update(['email'=>$email,]);

            return Response::json(['data' => 'OK']);
        }else {
            return Response::json(['data' => 'FALSE']);
        }


    }

}